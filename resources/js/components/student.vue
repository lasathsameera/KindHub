<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Students List</div>
                <div class="card-tools ">
                  <button class="btn btn-success float-right" @click="newModal">Add New <i class="fas fa-user-plus fa-fw"></i></button>
                </div>
                    <div class="card-body">
                         <table class="table table-hover">
                  <tbody>
                    <tr>
                        <th>Class Room</th>
                        <th>Teachers Name</th>
                        <th>Student First Name</th>
                        <th>Student Lasat Name</th>
                        <th>Gender</th>
                        <th>Joined Year</th>
                        <th>Created Date</th>
                        <th>Edit</th>
                        <th>Delete</th>
                  </tr>


                <tr v-for="student in students.data" :key="student.id">

                    <td>{{student.class_room}}</td>
                    <td>{{student.teachers_name}}</td>
                    <td>{{student.student_firstname}}</td>
                    <td>{{student.student_lastname}}</td>
                    <td>{{student.gender}}</td>
                     <td>{{student.joined_year}}</td>
                     <td>{{student.created_at}}</td>
                      <td>
                        <a href="#" @click="editModal(student)">
                            <i class="fa fa-edit blue"></i>
                        </a>
                       </td>
                       <td> 
                        <a href="#" @click="deleteUser(student.id)">
                            <i class="fa fa-trash red"></i>
                        </a>

                    </td>

                  </tr>
                </tbody></table>
               
                    </div>
                    <div class="card-footer">
                    <pagination :data="students" @pagination-change-page="getResults"></pagination>
  
                    </div>
                </div>
            </div>
             <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add New</h5>
                    <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update User's Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
              <form @submit.prevent="editmode ? updateStudent() : createStudent()">
                <div class="modal-body">

                      <div class="form-group">
                      <label for="exampleInputEmail1">Class Room</label>
                        <select name="classRoom" v-model="form.classRoom" id="classRoom" class="form-control" :class="{ 'is-invalid': form.errors.has('classRoom') }">
                            <option value="">Select Class Room</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                        </select>
                        <has-error :form="form" field="classRoom"></has-error>
                    </div>

                      <div class="form-group">
                      <label for="exampleInputEmail1">Teachers Name</label>
                        <select name="teachersName" v-model="form.teachersName" id="teachersName" class="form-control" :class="{ 'is-invalid': form.errors.has('teachersName') }">
                            <option value="">Select User Role</option>
                            <option value="Emily">Emily</option>
                            <option value="Isabella">Isabella</option>
                        </select>
                        <has-error :form="form" field="teachersName"></has-error>
                    </div>
                   <div class="form-group">
                   <label for="exampleInputEmail1">Student First Name</label>
                        <input v-model="form.studentFirstName" type="text" name="studentFirstName" id="studentFirstName"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('studentFirstName') }">
                        <has-error :form="form" field="studentFirstName"></has-error>
                    </div>

                    <div class="form-group">
                    <label for="exampleInputEmail1">Student Last Name</label>
                        <input v-model="form.studentLastName" type="text" name="studentLastName" id="studentLastName"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('studentLastName') }">
                        <has-error :form="form" field="studentLastName"></has-error>
                    </div>
                      <div class="form-group">
                      <label for="exampleInputEmail1">Gender</label>
                        <select name="gender" v-model="form.gender" id="gender" class="form-control" :class="{ 'is-invalid': form.errors.has('gender') }">
                            <option value="M">M</option>
                            <option value="F">F</option>
                        </select>
                        <has-error :form="form" field="gender"></has-error>
                    </div>
                    <div class="form-group">
                    <label for="exampleInputEmail1">Joined Year</label>
                        <input v-model="form.joinedYear" type="text" name="joinedYear" id="joinedYear"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('joinedYear') }">
                        <has-error :form="form" field="joinedYear"></has-error>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                    <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
                </div>

                </form>

                </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script src="../form.js"></script>
<script>

import Form from 'vform'
     export default {
        data() {
            return {

                editmode: false,
                students : {},
                  form: new Form({
                    id: '',
                    classRoom:'',
                    teachersName : '',
                    studentFirstName: '',
                    studentLastName: '',
                    gender: '',
                    joinedYear: ''
                })
              
            }
        },
        methods: {

            getResults(page = 1) {
			axios.get('api/student?page=' + page)
				.then(response => {
					this.students = response.data;
				});
		},

          editModal(student){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.id = student.id;
                this.form.classRoom = student.class_room;
                this.form.teachersName = student.teachers_name;
                this.form.studentFirstName = student.student_firstname;
                this.form.studentLastName = student.student_lastname;
                this.form.gender = student.gender;
                this.form.joinedYear = student.joined_year;
              
          },
          createStudent(){
             
                // Fire.$emit('AfterCreate');
                this.form.post('api/student');
                 $('#addNew').modal('hide')
                 Toast.fire({
                    icon: 'success',
                    title: 'Creating in successfully'
                    })
            
                },
                updateStudent(){

                this.form.put('api/student/'+this.form.id)
                 $('#addNew').modal('hide');
                                 Toast.fire({
                icon: 'success',
                title: 'Updating in successfully'
                })
               
            },
          
          newModal(){

            this.editmode = false;
            this.form.reset();
            $('#addNew').modal('show');
          },
           deleteUser(id){

               swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.value) {
                 
                    this.form.delete('api/student/'+id).then(()=>{
                                        swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                    )
                                
                    }).catch(()=> {
                    swal.fire("Failed!", "There was something wronge.", "warning");
                });
                }
                })
             
            },
            loadStudents(){
               
                axios.get("api/student").then(({ data }) => (this.students = data));
                     
            }
    
     },
     created() {

            this.loadStudents();
            setInterval(() => this.loadStudents(), 4000);

    }

     }
     
     
</script>
