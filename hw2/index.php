<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <title>All Employs!</title>

</head>

<body>
  <div class="container">
  <h1>All Employ!</h1>

  <table class="table table-sm table-stripe">
    <thead>
      <tr>
        <th>Sn</th>
        <th>Name</th>
        <th>Email</th>
        <th>Age</th>
        <th>Designation</th>
        <th>Created</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody id="tbody">

    </tbody>
  </table>

  <hr>
  <div id="create">
    <h1>Add new Employ</h1>
    <form id="insertForm" method="POST">
      <div class="row">
        <div class="col">
          <input type="text" class="form-control" placeholder="Name" name="name" id="name">
        </div>
        <div class="col">
          <input type="email" class="form-control" placeholder="Email" name="email" id="email">
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col">
          <input type="number" class="form-control" placeholder="Age" name="age" id="age">
        </div>
        <div class="col">
          <input type="text" class="form-control" placeholder="Designation" name="designation" id="designation">
        </div>
      </div><br>
      <button class="btn btn-primary btn-md float-right" type="button" onclick="Insert(this)">Insert</button>
    </form>
  </div>

  <div id="edit">
    <h1>Edit Employ</h1>
    <form id="form" method="POST">
      <div class="row">
        <div class="col">
          <input type="hidden" name="id" id="ids">
          <input type="text" class="form-control" placeholder="Name" name="name" id="ename" value="">
        </div>
        <div class="col">
          <input type="email" class="form-control" placeholder="Email" name="email" id="eemail">
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col">
          <input type="number" class="form-control" placeholder="Age" name="age" id="eage">
        </div>
        <div class="col">
          <input type="text" class="form-control" placeholder="Designation" name="designation" id="edesignation">
        </div>
      </div> <br>
      <button class="btn btn-secondary btn-md float-right " type="button" onclick="update(this)">Update</button>
    </form>
  </div>
  </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <script>
    const divEdit = document.getElementById('edit');
    const divcreate = document.getElementById('create');

    divEdit.style.display = 'none';


    function readall() {
      fetch("api/read.php", {
        method: "POST",
        headers: {
          "Content-type": "application/x-www-form-urlencoded",
          "X-Requested-With": "XMLHttpRequest",
        },

      }).then(async res => {

        let response = await res.json();
        var tbody = document.getElementById('tbody');
        tbody.innerHTML ="";
        var count = 0;
        var i = 0;
        if (response) {
          console.log("fetch response", response.body);
          while (i <= response.body.length) {



            tbody.innerHTML += "<tr>" +
              "<td>" + ++count + "</td>" +
              "<td>" + response.body[i].name + "</td>" +
              "<td>" + response.body[i].email + "</td>" +
              "<td>" + response.body[i].age + "</td>" +
              "<td>" + response.body[i].designation + "</td>" +
              "<td>" + response.body[i].created + "</td>" +

              "<td>  <button onclick='edit(" + response.body[i].id + ")'>Edit</button>  <button onclick='remove(" + response.body[i].id + ")'>Remove</button> </td>"
            "</tr>"
            i++;
          }

        } else {

        }
      });
    }

    readall();

    function Insert(form) {

     
      name = document.getElementById('name').value;
      email = document.getElementById('email').value;
      age = document.getElementById('age').value;
      designation = document.getElementById('designation').value;
      const object = {
        name: name,
        email: email,
        age: age,
        designation: designation
      };
      //console.log(name)
      //fetch api version of purchase call
      fetch("api/create.php", {
        method: "POST",
        headers: {
          "Content-type": "application/x-www-form-urlencoded",
          "X-Requested-With": "XMLHttpRequest",
        },
        body: JSON.stringify(object)
      }).then(async res => {
     form.reset();
        let data = await res.json();
      
        if (data.status === 200) {
         
        } else {
          //readall();
        }
      });
     
      location.reload();
    }
  </script>


  <script>
    function remove(e) {
      console.log(e + "from remove");
      if (confirm('Are you sure you want to remove this product from Wishlist')) {
        // Save it!
        //fetch api version of remove cart
        fetch("api/delete.php", {
          method: "POST",
          headers: {
            "Content-type": "application/x-www-form-urlencoded",
            "X-Requested-With": "XMLHttpRequest",
          },
          body: JSON.stringify({
            id: e
          })
        }).then(async res => {
          console.log(res);
          let data = await res.json();
          console.log("fetch response", data);

          location.reload();

          if (data.status === 200) {

          } else {

          }

        });
      } else {

        console.log('Thing was not saved to the database.');
      }

    }
  </script>
  <script>
    function edit(e) {

      divEdit.style.display = 'block';
      divcreate.style.display = 'none';
      // Save it!
      //fetch api version of remove cart
      fetch("api/single_read.php?id=" + e, {
        method: "GET",
        headers: {
          "Content-type": "application/x-www-form-urlencoded",
          "X-Requested-With": "XMLHttpRequest",
        },

      }).then(async res => {
        //console.log(res);
        let data = await res.json();


        //  readall()

        if (data) {
          console.log("fetch response", data.name);
          document.getElementById('ename').value = data.name;
          document.getElementById('ids').value = data.id;
          document.getElementById('eemail').value = data.email;
          document.getElementById('eage').value = data.age;
          document.getElementById('edesignation').value = data.designation;
        } else {

        }

      });
    }
  </script>

<script>

function update(form) {
      name = document.getElementById('ename').value;
      email = document.getElementById('eemail').value;
      age = document.getElementById('eage').value;
      id= document.getElementById('ids').value;
      designation = document.getElementById('edesignation').value;
      const object = {
        name: name,
        email: email,
        age: age,
        designation: designation,
        id: id
      };
      //console.log(name)
      //fetch api version of purchase call
      fetch("api/update.php", {
        method: "POST",
        headers: {
          "Content-type": "application/x-www-form-urlencoded",
          "X-Requested-With": "XMLHttpRequest",
        },
        body: JSON.stringify(object)
      }).then(async res => {
        console.log(res);
        let data = await res.json();

        if (data.status === 200) {

        } else {
          //
        }
      });
      divEdit.style.display = 'none';
      divcreate.style.display = 'block';
      location.reload();

    }

</script>

</body>

</html>