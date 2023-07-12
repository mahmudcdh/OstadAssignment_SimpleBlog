<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blog Posts') }}
        </h2>
    </x-slot>

    <!-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div> -->

    <div class="container mt-3">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5>Categories Lists</h5>
                        <span id="successMsg"></span>
                        <table class="table table-bordered table-sm table-hover mt-2">
                            <thead>
                                <tr>
                                    <td>Sl</td>
                                    <td>Posts Title</td>
                                    <td>Category</td>
                                    <td>Image</td>
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
                        <h2>Add New Post</h2>
                        <form id="myForm" class="mt-2">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="title" id="title" placeholder="Post Title" required>
                                <label for="category_name">Post Title</label>
                            </div>

                            <div class="form-floating mb-3">
                                <textarea class="form-control" name="content" placeholder="content" id="content"></textarea>
                                <label for="content">Content</label>
                            </div>

                            <div class="form-floating mb-3">
                                <select class="form-select" name="category_id" id="category_id" aria-label="Category">
                                    <option selected>Select Category</option>
                                </select>
                                <label for="floatingSelect">Category</label>
                            </div>

                            <div class="form-group mb-3">
                                <label for="image">Image</label>
                                <input type="file" class="form-control-file" id="image" name="image" required>
                            </div>

                            <button type="submit" class="btn btn-outline-primary btn-sm"><i class="fas fa-upload"></i> Publish</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<script>
    //Get Category in Combo List
    getCategory()
    function getCategory(){
        axios.get('api/category')
             .then(function(response){
                const data = response.data
                const option = document.getElementById('category_id')

                data.forEach(function(row){
                    option.innerHTML +=(`
                        <option value='${row['id']}'>${row['category_name']}</option>
                    `)
                })
             })
             .catch(error =>{
                console.log(error.response)
            })
    }

    //Get Posts List
    getPostsList()
    function getPostsList(){
        axios.get('blog/posts')
             .then(function(response){
                const data = response.data
                const tbody = document.getElementById('table-body')
                tbody.innerHTML=''

                data.forEach(function(row){
                    tbody.innerHTML +=(`
                        <tr>
                            <td>${row['id']}</td>
                            <td>${row['title']}</td>
                            <td>${row.category['category_name']}</td>
                            <td>${row['image']}</td>
                            <td>
                                <button class='btn btn-outline-secondary btn-sm'><i class="far fa-edit"></i></button>
                                <button class='btn btn-outline-danger btn-sm'><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    `)
                })

             })
             .catch(error =>{
                console.log(error.response)
            })
    }

    //Create Post
    /* addPost()
    function addPost(){
        let myForm = document.forms['myForm']
        let titleInput = myForm['title']
        let contentInput = myForm['content']
        let categoryIdInput = myForm['category_id']

        myForm.onsubmit = function (e){
            e.preventDefault()
            axios.post('blog/store-posts', {
                headers: {
                        'Content-Type': 'multipart/form-data'
                    },
                title:titleInput.value,
                content:contentInput.value,
                category_id:categoryIdInput.value,
            })
            .then(response =>{
                console.log(response)
                document.getElementById('successMsg').innerHTML = (`
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>${response.data.msg}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `);
                myForm.reset()
                getPostsList();

            })
            .catch(error =>{
                console.log(error.response)
            })
        }
    } */

    $('#myForm').submit(function (event) {
            event.preventDefault(); // Prevent the form from submitting normally

            const formData = new FormData(this); // Create FormData object

            axios.post('blog/store-posts', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then(function (response) {
                // Handle success response
                console.log(response.data); // You can handle the response data as per your requirements

                // Clear form fields
                $('#myForm')[0].reset();
            })
            .catch(function (error) {
                // Handle error response
                console.error(error);
            });
        });

</script>
