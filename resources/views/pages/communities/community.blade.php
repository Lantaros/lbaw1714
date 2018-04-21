@extends('layout')

@section('content')
   <div class="container">
        <legend style=" color: #333; padding: 20px; margin-left: 0; padding-left: 0; padding-bottom: 0;">
            <i class="fas fa-users"></i>
            <span style="margin-left: .5rem;">
                <b>{{$community->name}}'s</b> Community
            </span>
        </legend>

        <div class="bs-docs-section">
            <div class="row">
                <div class="col-lg-4" style="padding-top: 23px;">
                    <div class="bs-ccomponent">
                        <img src="{{$community->imagepath}}" style="width: 100%; height: 200px; object-fit: cover;">
                        <br>
                        <br>

                        <div class="col-lg-12" style="padding-left: 0; padding-right: 0;">
                            <div class="bs-ccomponent">
                                <div style="background-color: #eee; padding: 20px; padding-top: 10px;">
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputDefault">
                                                <b>About</b>
                                            </label>
                                            <p>{{$community->description}}
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputDefault">
                                                <b>Membership details</b>
                                            </label>
                                            <p>
                                                <a href="#" style="color: #f3a933dc">{{$community->members()}} members</a>, including
                                                <a href="#" style="color: #f36833">God</a> and
                                                <a href="#" style="color: #f36833">Rui Leixo</a>
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputDefault">
                                                <b>Administrators</b>
                                            </label>
                                            <p>
                                                <a href="#" style="color: #f36833">God</a>
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputDefault">
                                                <b>Created on</b>
                                            </label>
                                            <p>{{$community->printDate()}}</p>
                                        </div>
                                    </fieldset>

                                    <button type="submit" style="background-color: #f3a933dc; border-color: #f5956f" onclick="event.preventDefault(); location.href = 'register2.html';"
                                     class="btn btn-info">Message the admins</button>
                                     <button type="submit" style="border-color: #f5956f" onclick="event.preventDefault(); location.href = 'register2.html';"
                                     class="btn btn-danger">Report</button>
                                     <button type="submit" style="background-color: #f3a933dc; border-color: #f5956f; margin-top:5px;" onclick="event.preventDefault(); location.href = 'register2.html';"
                                        class="btn btn-info">Add Members</button>

                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <div style="text-align: right;">
                                        <span class="badge badge-danger">Private</span>
                                        <span class="badge badge-info">Academic</span>
                                        <span class="badge badge-dark">Just for fun</span>
                                    </div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 100%; background-color: #f36833;" aria-valuenow="100" aria-valuemin="0"
                                     aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-8" style="padding-top:23px">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#feed" style="color: #f36833">Activity Feed</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#upcoming" style="color: #f36833">Upcoming Events</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#history" style="color: #f36833">Event History</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane fade show active" id="feed">
                            <div class="col-lg-12" style="padding-left: 0px;padding-right: 0px;">
                                <div class="bs-ccomponent">
                                    <div class="list-group">
                                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                            <h5 class="mb-1">Y'all need Jesus</h5>
                                            <small class="text-muted">Right now</small>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                            <h5 class="mb-1">Feupinhos created a new Event: Feupinhos na Queima.</h5>
                                            <small>1 day ago</small>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                            <h5 class="mb-1">Feupinhos attended an Event: Synergy in FEUP</h5>
                                            <small class="text-muted">2 days ago</small>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                            <h5 class="mb-1">Daniel Pinho joined Feupinhos.</h5>
                                            <small class="text-muted">3 days ago</small>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div style="margin-top: 1rem; margin-left: 0;">
                                <ul class="pagination ">
                                    <li class="page-item disabled ">
                                        <a class="page-link " href="# ">&laquo;</a>
                                    </li>
                                    <li class="page-item active ">
                                        <a class="page-link " href="# " style="background-color:#f36833; border-color:#f36833;">1</a>
                                    </li>
                                    <li class="page-item ">
                                        <a class="page-link " href="# ">2</a>
                                    </li>
                                    <li class="page-item ">
                                        <a class="page-link " href="# ">3</a>
                                    </li>
                                    <li class="page-item ">
                                        <a class="page-link " href="# ">&raquo;</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="upcoming">
                            <div class="col-lg-12" style="padding-left: 0px;padding-right: 0px;">
                                <div class="bs-ccomponent">
                                    <div class="list-group-item list-group-item-action flex-column align-items-start">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">Piggybank Party</h5>
                                            <small>Tomorrow</small>
                                        </div>
                                        <a href="">
                                            <small> Click here to see the event.</small>
                                        </a>
                                    </div>
                                    <div class="list-group-item list-group-item-action flex-column align-items-start">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">LBAW A4 </h5>
                                            <small class="text-muted">In 4 days</small>
                                        </div>
                                        <a href="">
                                            <small> Click here to see the event.</small>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div style="margin-top: 1rem; margin-left: 0;">
                                <ul class="pagination ">
                                    <li class="page-item disabled ">
                                        <a class="page-link " href="# ">&laquo;</a>
                                    </li>
                                    <li class="page-item active ">
                                        <a class="page-link " href="# " style="background-color:#f36833; border-color:#f36833;">1</a>
                                    </li>
                                    <li class="page-item ">
                                        <a class="page-link " href="# ">2</a>
                                    </li>
                                    <li class="page-item ">
                                        <a class="page-link " href="# ">3</a>
                                    </li>
                                    <li class="page-item ">
                                        <a class="page-link " href="# ">&raquo;</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="history">
                            <div class="col-lg-12" style="padding-left: 0px;padding-right: 0px;">
                                <div class="bs-ccomponent">
                                    <div class="list-group">
                                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1">MPCP Test</h5>
                                                <small>Tomorrow</small>
                                            </div>
                                            <p class="mb-1">The test no one wants to have!</p>
                                            <a href="">
                                                <small> Click here to see the event.</small>
                                            </a>
                                        </div>

                                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1">Piggybank Party</h5>
                                                <small>Tomorrow</small>
                                            </div>
                                            <p class="mb-1">The party to all piggy lovers!</p>
                                            <a href="">
                                                <small> Click here to see the event.</small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="margin-top: 1rem; margin-left: 0;">
                                <ul class="pagination ">
                                    <li class="page-item disabled ">
                                        <a class="page-link " href="# ">&laquo;</a>
                                    </li>
                                    <li class="page-item active ">
                                        <a class="page-link " href="# " style="background-color:#f36833; border-color:#f36833;">1</a>
                                    </li>
                                    <li class="page-item ">
                                        <a class="page-link " href="# ">2</a>
                                    </li>
                                    <li class="page-item ">
                                        <a class="page-link " href="# ">3</a>
                                    </li>
                                    <li class="page-item ">
                                        <a class="page-link " href="# ">&raquo;</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
@endsection
