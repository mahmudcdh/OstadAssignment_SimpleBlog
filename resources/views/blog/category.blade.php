<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Category Page
        </h2>
    </x-slot>

    <!-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2>Category Page</h2>
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
                        <form name="myForm" action="" id="myForm" class="mt-2">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="category_name" id="category_name" placeholder="Category Name" required>
                                <label for="category_name">Category Name</label>
                            </div>
                            <button type="submit" class="btn btn-outline-primary btn-sm"><i class="fas fa-save"></i> Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<script>
    categoryList();
    async function categoryList(page = 1){
        try{
            let res = await axios.get(`{{ route('category.index')}}`)
            let tbody = document.getElementById('table-body')
            tbody.innerHTML = ''

            res.data.forEach((item)=>{
                tbody.innerHTML +=`<tr>
                                    <td>${item['id']}</td>
                                    <td>${item['category_name']}</td>
                                    <td>
                                        <button class='btn btn-outline-secondary btn-sm'><i class="far fa-edit"></i></button>
                                        <button class='btn btn-outline-danger btn-sm'><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>`;
            })

        }
        catch(e){
            console.error(e)
        }
    }

    //Add Category
    /* $('#myForm').submit(async function(e){
        e.preventDefault();

        const formData = new FormData(this)

        try{
            const res = await axios.post('api/category', formData)
            console.log(response.data)
            $('#myForm')[0].reset()
        }
        catch(e){
            console.error(e)
        }
    })
 */

    addCategory()
    function addCategory(){
        let myForm = document.forms['myForm']
        let categoryNameInput = myForm['category_name']

        myForm.onsubmit = function (e){
            e.preventDefault()
            axios.post('api/category', {
                category_name:categoryNameInput.value
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
                categoryList();

            })
            .catch(error =>{
                console.log(error.response)
            })
        }
    }

</script>
