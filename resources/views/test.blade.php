<html>
<head>
    <script type="text/javascript">
      
        function changeText(){
            document.getElementById('test1').innerHTML = 'Good Morning';
        }
      
        function testSync() {
        	var string = "default string";
        	string = window.MyHandler.testString();
        	document.getElementById('test1').innerHTML = string;
        }
    </script>


</head>
<body>

<h1 id="test1">Hello World</h1>
</body>
</html>