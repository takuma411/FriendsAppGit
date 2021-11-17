
<header>
    <div class="point-view">
   <a href="confirm_gift.php?user_unique_id=<?=$_SESSION['user_unique_id']?>"class="confirm_gift"><p class="point-p"><?=$data['gift_point']?>P</p></a>
    </div>
    <div class="gift-icon">
       <button onclick="location.href='gift_exchange.php?user_unique_id=<?=$_SESSION['user_unique_id']?>'" class="btn btn-warning"><i class="fas fa-gifts"></i></button> 
    </div>
</header>
