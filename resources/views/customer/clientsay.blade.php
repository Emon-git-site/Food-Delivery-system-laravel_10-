
@extends('layouts.frontend')
@section('content')
<div class="main__body m-4">
    <div class="profile-inner">
        <div class="container">
            <div class="row pt-2">
                <div class="col-md-3 col-lg-3">
                @include('customer.sidebar')
                </div>
                <div class="col-md-9 col-lg-9 pt-3">
                    <div class="row">
                        <div class="col-lg-8 mt-2">
                            <div class="card">
                                @isset($check)
                                <h3 class="p-2"> Update Your Review</h3>
                                <form class="p-4" method="post" action="{{ route('customer.comment.update') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="hidden" name="id" value="{{ $check->id }}">
                                        <label for="rating">Select Rating</label>
                                        <select class="form-control" name="rating">
                                            <option value="1" @selected($check->rating==1)>1 Star</option>
                                            <option value="2" @selected($check->rating==2)>2 Star</option>
                                            <option value="3" @selected($check->rating==3)>3 Star</option>
                                            <option value="4" @selected($check->rating==4)>4 Star</option>
                                            <option value="5" @selected($check->rating==5)>5 Star</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="message">Write Review</label>
                                        <textarea class="form-control" name="message"  rows="10">{{ $check->message }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-success ">Update</button>
                                </form>
                                @else
                                <h3 class="p-2"> Write Your Review</h3>
                                <form class="p-4" method="post" action="{{ route('customer.comment.store') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="rating">Select Rating</label>
                                        <select class="form-control" name="rating">
                                            <option value="1">1 Star</option>
                                            <option value="2">2 Star</option>
                                            <option value="3">3 Star</option>
                                            <option value="4">4 Star</option>
                                            <option value="5">5 Star</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="message">Write Review</label>
                                        <textarea class="form-control" name="message"  rows="10"></textarea>
                                    </div>
                                    {{-- <div class="from-group form-check">
                                        <input type="checkbox" class="form-check-input" id="own_review" required>
                                        <label class="form-check-label" for="own_review">I write my own review</label>
                                    </div> --}}
                                    <button type="submit" class="btn btn-success  ">Submit</button>
                                </form>
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
</div>
@endsection 