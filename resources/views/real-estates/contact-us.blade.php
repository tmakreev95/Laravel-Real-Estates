@extends('layouts.master')

@section('content')
<div class="row">
  <div class="col-md-6 col-md-offset-2 contact-us-wrapper">
    <h1>Contact Us </h1>
    @if(count($errors) > 0)
    <div class="alert alert-danger">
      @foreach($errors->all() as $error)
      <p>{{ $error }}</p>
      @endforeach
    </div>
    @endif
    @if($message)
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <form action="{{ route('contact-us') }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="subject">Subject</label>
            <select name="subject" required class="form-control" id="subject">
                <option>Real Estate Request</option>
                <option>Real Estate Approval Request</option>
                <option>User Account Request</option>
            </select>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input required class="form-control" type="email" name="email" required id="email" value="" placeholder="Enter your email address">
        </div>
        <div class="col-md-12 p-0">
            <div class="form-group col-md-6 pull-left p-1">
                <label for="first-name">First name</label>
                <input class="form-control" type="text" name="first-name" required id="first-name" value="" placeholder="Enter your first name">
            </div>
            <div class="form-group col-md-6 pull-left p-1">
                <label for="last-name">Last name</label>
                <input class="form-control" type="text" name="last-name" required id="last-name" value="" placeholder="Enter your last name">
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- <div class="input-group">            
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="inputGroupFile01"
                aria-describedby="inputGroupFileAddon01" name="attachment">
                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
            </div>
        </div> -->
        <div class="form-group">
            <label for="attachment">Attachment</label>
            <input type="file" name="attachment" class="form-control-file" id="attachment">
        </div>
        <div class="form-group">
            <label for="message">Message</label>
            <textarea required name="message" placeholder="Enter a message" name="message" class="form-control" id="message" rows="3"></textarea>
        </div>            
      
      <input type="submit" class="btn btn-primary pull-right" name="submit" value="Send">
      {{ csrf_field() }}
    </form>
  </div>
</div>
@endsection
