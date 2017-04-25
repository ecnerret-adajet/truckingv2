@extends('layouts.app')

@section('content')
           <div class="container-fluid">

                <div class="row">
                <!-- table  -->
                    <div class="col-md-5">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Email Notification</h4>
                                <p class="category">Total trucks entered this day</p>
                            </div>
                           <hr/>
                            
                             
                                    {{-- <table class="table" id="email_table">
                                            <thead>
                                            <tr>
                                                <th>
                                                    Email Address
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="email in emails">
                                                <td>@{{ email }}</td>
                                            </tr>
                                            <tr>    
                                                <td>

                                                <div class="form-group">
                                                  <label class="control-label">Add Email</label>
                                                  <div class="input-group">
                                                    <span class="input-group-addon">@</span>
                                                    <input type="text" class="form-control" v-model="newEmail" @keyUp.enter="addEmail" :disabled=" emails.length > 6 ? true : false ">
                                                    <span class="input-group-btn">
                                                      <button class="btn btn-primary btn-fill" type="button" @click="addEmail" :disabled=" emails.length > 6 ? true : false ">Add</button>
                                                    </span>
                                                  </div>
                                                </div>

                                                </td>
                                            </tr>
                                            </tbody>
                                    </table> --}}
                          
                        </div>
                    </div>
                </div><!-- end row -->
            </div>
@endsection
