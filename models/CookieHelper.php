<?php


function showCookie()
{
    echo "<h1 class = 'text-center' h1>Wochenkarte</h1>";
    echo "<div class = 'text-center'>Willkommen</div>";
    echo "<div class = 'text-center'>Diese Website verwendet Cookies</div>";
    echo "  
    <div class = 'text-center'>
        <form action='index.php' method='post'>
            <input type='submit' name='accept' id='accept' value='Akzeptieren' class=' btn btn-warning '>
        </form>
    </div>"
    ;

}
function checkCookie()
{

    if(isset($_COOKIE["cookie"]) && $_COOKIE["cookie"] == "true")
    {
        return true;
    }
    else return false;
}

function cookiesetter()
{
    setcookie("cookie", "true");
}
?>