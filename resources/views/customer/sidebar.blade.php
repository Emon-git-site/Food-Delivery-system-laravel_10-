<div class="left__side__bg ">
    <div class="shop__filter">
        <!-- <h5> ACCOUNT</h5> -->
        <div class="shop__fl__body">
            <div class="profile__head">
                <div class="user__name">
                    <img src="{{ asset('frontend') }}/img/user/avatar-3.jpg" class="user__image" alt="">
                    <h3>Helal Uddin</h3>
                </div>
            </div>
            <div class="list-group">
                <ul class="list-item">
                    <li class="active"><a href="{{ route('home') }}"><i class="fa fa-home"></i> Dashboard</a></li>
                    <li><a href=""><i class="fa fa-file-medical-alt"></i> Purchase History</a></li>
                    <li><a href=""><i class="fa fa-download"></i> Download</a></li>
                    <li><a href=""><i class="fa fa-heart"></i> Wishlist</a></li>
                    <li><a href=""><i class="fa fa-gem"></i> Classified Product</a></li>
                    <li><a href=""><i class="fa fa-clipboard"></i> Conversations</a></li>
                    <li><a href=""><i class="fa fa-dollar-sign"></i> My Wallet</a></li>
                    <li><a href=""><i class="fa fa-ticket-alt"></i> Support Ticket</a></li>
                    <li><a href="{{ route('customer.comment') }}"><i class="fa fa-user-cog"></i> Write a review</a></li>
                    <li><a href="#" 
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        ><i class="fa fa-user-cog"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST"
class="d-none">
@csrf
</form>