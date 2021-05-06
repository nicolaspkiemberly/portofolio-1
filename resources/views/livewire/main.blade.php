<div class="main">
    <div class="text-section">
        <h1 class="user-name">{{Auth::user()->name}}</h1>
        <hr>
        <h3 class="user-desc">{{Auth::user()->description}}</h3>
    </div>
    <div class="image-selection">
        <img class="profile-img" src="{{Auth::user()->profile_photo_url}}" alt="profile_image" width="125" height="125">
    </div>
</div>
