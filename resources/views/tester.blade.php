<!DOCTYPE html>
<html>
<body>

<p>Click the button to wait 3 seconds, then alert "Hello".</p>

<button onclick="myFunction()">Try it</button>

<script>




function fun() {
   alert("Hello"); 
}
function myFunction() {





  setTimeout("fun()", 5000);
}
</script>

</body>
</html>
