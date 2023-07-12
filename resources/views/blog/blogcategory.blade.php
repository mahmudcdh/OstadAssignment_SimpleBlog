<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>

<body>

    <div class="container mt-3">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5>Categories Lists</h5>
                        <table class="table table-bordered table-sm table-hover mt-2">
                            <thead>
                                <tr>
                                    <td>Sl</td>
                                    <td>Category Name</td>
                                    <td>Actions</td>
                                </tr>
                            </thead>
                            <tbody id="table-body">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h2>Add Category</h2>
                        <form name="myForm" action="" class="mt-2">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="category_name" id="category_name" placeholder="Category Name">
                                <label for="category_name">Category Name</label>
                            </div>
                            <button type="submit" class="btn btn-outline-primary btn-sm">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        getData();
        async function getData(){
        try{
            let res = await axios.get("/category")
            //let tableBody = document.getElementById("table-body")

            res.data.forEach((item)=>{
                document.getElementById("table-body").innerHTML +=(
                                `<tr>
                                    <td>${item['id']}</td>
                                    <td>${item['category_name']}</td>
                                    <td>
                                        <button class='btn btn-outline-information btn-sm'>Edit</button>
                                        <button class='btn btn-outline-danger btn-sm'>Delete</button>
                                    </td>
                                </tr>`
                            )
            })
        }
        catch (e) {

        }
    }

    addCategory()
    async function addCategory(){
        try{
            let myForm = document.forms['myForm']
            let categoryInput = myForm['category_name']

            myForm.onsubmit = async function(e){
                e.preventDefault();
                await axios.post('/category',{
                    category_name: categoryInput.value,
                })
                console.log(response)
            }
        }
        catch(e){

        }
    }
</script>
</body>

</html>
