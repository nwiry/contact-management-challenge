@extends("base")

@section("content")
<div class="container">
    <div class="row">
        <h3>Contact Management
            Web application
        </h3>
        <p>The application is an online system designed for easy contact management. You can add new contacts, edit
            existing information, view details for each contact, and delete records as needed. The interface is
            simple and intuitive, ensuring a user-friendly experience. Additionally, your data is secure, with
            features in place to prevent accidental deletions. Enjoy the ease of using our system to keep your
            contact list organized!</p>
        <hr />
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-offset-3 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading c-list">
                    <span class="title">Contacts</span>
                    <ul class="pull-right c-controls">
                        <li><a href="#add-contact-modal" data-toggle="tooltip" data-placement="top"
                                title="Add Contact"><i class="glyphicon glyphicon-plus"></i></a></li>
                        <li><a href="#" class="hide-search" data-command="toggle-search" data-toggle="tooltip"
                                data-placement="top" title="Toggle Search"><i class="fa fa-search"></i></a></li>
                    </ul>
                </div>

                <div class="row" style="display: none;">
                    <div class="col-xs-12">
                        <div class="input-group c-search">
                            <input type="text" class="form-control" id="contact-list-search">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><span
                                        class="glyphicon glyphicon-search text-muted"></span></button>
                            </span>
                        </div>
                    </div>
                </div>

                <ul class="list-group" id="contact-list">
                    @foreach ($contacts as $contact)
                    <li class="list-group-item">
                        <div class="col-xs-12 col-sm-3">
                            <img src="https://gravatar730.files.wordpress.com/2023/10/logo.png?w=240"
                                alt="Scott Stevens" class="img-responsive img-circle" />
                        </div>
                        <div class="col-xs-12 col-sm-9">
                            <span class="name">{{$contact->name}}</span><br />
                            <span class="glyphicon glyphicon-earphone text-muted c-info" data-toggle="tooltip"
                                title="{{$contact->contact}}"></span>
                            <span class="visible-xs"> <span class="text-muted">{{$contact->contact}}</span></span>
                            <span class="fa fa-envelope text-muted c-info" data-toggle="tooltip"
                                title="{{$contact->email}}"></span>
                            <span class="visible-xs"> <span class="text-muted">{{$contact->email}}</span></span>
                            <span class="fa fa-edit text-muted c-info" data-toggle="tooltip" title="Edit Contact"
                                data-name="{{$contact->name}}" data-contact="{{$contact->contact}}"
                                data-email="{{$contact->email}}" data-id="{{$contact->id}}" onclick="editContactModal(this)"></span>
                            <span class="fa fa-times text-muted c-info" data-toggle="tooltip" title="Delete Contact"
                                data-name="{{$contact->name}}" data-id="{{$contact->id}}"
                                onclick="deleteContact(this)"></span>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div id="add-contact-modal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog"
        aria-labelledby="addContactLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="addContactLabel">Add Contact</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger alert-error mb-1" style="display: none;">
                    </div>
                    <form action="javascript:void(0);">
                        <div class="form-group mb-3">
                            <label for="contact-name">Name</label>
                            <input type="text" class="form-control" placeholder="Contact Name" id="contact-name">
                        </div>
                        <div class="form-group mb-3">
                            <label for="contact-phone">Phone</label>
                            <input type="text" class="form-control" placeholder="Contact Phone" id="contact-contact">
                        </div>

                        <div class="form-group mb-3">
                            <label for="contact-mail">E-mail</label>
                            <input type="text" class="form-control" placeholder="Contact E-mail" id="contact-mail">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="addContact();">Add Contact</button>
                    <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>


    <div id="edit-contact-modal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog"
        aria-labelledby="editContactLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="editContactLabel">Add Contact</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger alert-error-edit mb-1" style="display: none;">
                    </div>
                    <form action="javascript:void(0);">
                        <input type="hidden" id="edit-contact-id">
                        <div class="form-group mb-3">
                            <label for="edit-contact-name">Name</label>
                            <input type="text" class="form-control" placeholder="Contact Name" id="edit-contact-name">
                        </div>
                        <div class="form-group mb-3">
                            <label for="edit-contact-phone">Phone</label>
                            <input type="text" class="form-control" placeholder="Contact Phone"
                                id="edit-contact-contact">
                        </div>

                        <div class="form-group mb-3">
                            <label for="edit-contact-mail">E-mail</label>
                            <input type="text" class="form-control" placeholder="Contact E-mail" id="edit-contact-mail">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="editContact();">Edit Contact</button>
                    <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section("scripts")
<script>
const CSRF_TOKEN = "{{csrf_token()}}";
</script>
<script src="/app.js?v=0.1"></script>
@endsection