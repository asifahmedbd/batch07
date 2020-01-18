<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
     <div class="container">
     	<ul>
	     	@foreach($cdip_students as $name)
				<li> {{ $name }} </li>	
	     	@endforeach
     	</ul>
     </div>
</body>
</html>