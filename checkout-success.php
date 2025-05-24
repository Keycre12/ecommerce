<?php include 'helpers/functions.php'; ?>
<?php template('header.php'); ?>

<style>
/* Page‐wide gradient background + subtle grain */
body {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    margin: 0;
    min-height: 100vh;
    position: relative;
}
body::before{
    content:'';
    position:absolute;
    inset:0;
    background:url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="g" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="1" fill="white" opacity="0.05"/><circle cx="90" cy="40" r="1" fill="white" opacity="0.08"/></pattern></defs><rect width="100" height="100" fill="url(%23g)"/></svg>');
    pointer-events:none;
}

/* Floating decorative blobs (reuse existing) */
.floating-elements{position:absolute;width:100%;height:100%;overflow:hidden;pointer-events:none;z-index:0;}
.floating-elements::before,
.floating-elements::after{
    content:'';
    position:absolute;
    border-radius:50%;
    background:rgba(255,255,255,0.1);
    animation:float 6s ease-in-out infinite;
}
.floating-elements::before{width:60px;height:60px;top:10%;right:10%;animation-delay:-2s;}
.floating-elements::after{width:40px;height:40px;bottom:20%;left:15%;animation-delay:-4s;}
@keyframes float{0%,100%{transform:translateY(0) rotate(0);opacity:.5;}50%{transform:translateY(-20px) rotate(180deg);opacity:.8;}}

/* Main card */
.thank-you-container{
    background:rgba(255,255,255,0.95);
    backdrop-filter:blur(20px);
    border-radius:24px;
    padding:40px;
    margin:40px auto;
    max-width:600px;
    box-shadow:0 20px 40px rgba(0,0,0,0.1),0 8px 16px rgba(0,0,0,0.1);
    border:1px solid rgba(255,255,255,0.2);
    text-align:center;
    position:relative;
    z-index:1;
}
.thank-you-container h1{color:#667eea;font-weight:800;margin:20px 0 10px;}
.thank-you-container p{color:#4a5568;font-size:1.1rem;margin-bottom:30px;}

/* Checkmark & new bus icon */
.checkmark{color:#48bb78;font-size:4rem;margin-bottom:10px;animation:bounce 1s ease;}
.bus-icon{
    color:#667eea;
    font-size:3rem;
    margin-bottom:20px;
    display:inline-block;
    animation:drive 2s ease-in-out infinite;
}
@keyframes bounce{0%,20%,50%,80%,100%{transform:translateY(0);}40%{transform:translateY(-30px);}60%{transform:translateY(-15px);}}
@keyframes drive{0%{transform:translateX(-5px);}50%{transform:translateX(5px);}100%{transform:translateX(-5px);}}

/* Button */
.btn-primary{
    background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);
    border:none;color:#fff;font-weight:600;padding:12px 30px;border-radius:12px;
    transition:all .3s ease;cursor:pointer;font-size:1rem;text-decoration:none;display:inline-block;
    box-shadow:0 4px 15px rgba(102,126,234,.3);
}
.btn-primary:hover{
    background:linear-gradient(135deg,#5a6fd1 0%,#6a4299 100%);
    transform:translateY(-2px);
    box-shadow:0 8px 25px rgba(102,126,234,.4);
    color:#fff;
}
</style>

<div class="floating-elements"></div>

<div class="thank-you-container">
    <div class="checkmark">✓</div>
    <!-- 🚚 Delivery bus icon (unicode) -->
    <div class="bus-icon">🚌</div>
    <h1>Thank You for Your Order!</h1>
    <p>Your order has been successfully placed. We'll notify you once it's on the way!</p>
    <a href="index.php" class="btn-primary">Back to Home</a>
</div>

<?php template('footer.php'); ?>
