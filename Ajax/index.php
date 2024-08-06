<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <title>Crud Using Ajax Jquery</title>
</head>
<body>
    <header class="p-4 bg-dark mb-5">
        <h1 class="text-light text-center">Crud Using Ajax</h1>
    </header>

    <div class="container mt-5">
        <div id="formDiv">
            <h1>ToDo List!</h1>
            <form id="addTodoForm">
                <input type="text" id="upkey" class="from-control" style="display:none;">
                <input type="text" name="entry" id="todoText" placeholder="Add your new ToDo...">
                <input type="submit" name="submit" id="todoAdd" value="+">
            </form>
            <ul id="todoUl" class="p-3">
                <!-- Todo items will be appended here -->
            </ul>
        </div>
    </div>



   








    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        $("#addTodoForm").on("submit", function(event) {
            event.preventDefault(); // Prevent the form from submitting the traditional way
            addTodo();
        });

        function addTodo() {
            let todoText = $("#todoText").val().trim();
            let upkey = $("#upkey").val();
                
            if (todoText === "") {
                alert("Please Enter a Value");
                return;
            }

            $.ajax({
                url: "addTodo.php",
                type: "POST",
                data: { id:upkey , entry: todoText },
                success: function(response) {
                    console.log(response);
                    $("#addTodoForm")[0].reset();
                    viewTodo();
                }
            });
        }

        function viewTodo() {
            $.ajax({
                url: "viewTodo.php",
                type: "GET",
                dataType: 'json',
                success: function(response) {
                    let result = "";
                    for (let i = 0; i < response.length; i++) {
                        result += `<li class="myti">${response[i].entry}
                          <span class="time">${response[i].time}</span>
                          <span class="btn btn-success" data-sid="${response[i].id}">Update</span> 
                          <span class="btn btn-danger" data-sid="${response[i].id}">Delete</span>
                          </li>`;
                    }
                    $("#todoUl").html(result);
                }
            });
        }

        viewTodo();

        $("#todoUl").on('click', '.btn-danger', function() {
            let id = $(this).data("sid");
            let mythis = this;
            $.ajax({
                url: "delete.php",
                type: "POST",
                data: { sid: id },
                success: function(response) {
                    if(response == 1){
                        console.log(response);
                    // viewTodo()
                    $(mythis).closest("li").fadeOut();
                    }
                   
                }
            })
        });
    });


    $("#todoUl").on('click' , '.btn-success' , function(){
        let id = $(this).data("sid");
        $.ajax({
            url: "update.php",
            type: "POST",
            dataType: "json",
            data: {sid:id},
            success:function(response){
               $("#upkey").val(response.id);
               $("#todoText").val(response.entry);
            }
        });
        
    });
    </script>
</body>
</html>
