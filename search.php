<html>
<head>
<title>Advanced search</title>
</head>
<body>
<form action="http://localhost/searchresult.php" method="post">
    
    <b>Advanced search</b>
    
    <p>Title:
<input type="text" name="title" size="30" value="" />
</p>

<p>Genre:
<select id="genre" name="genre">                      
  <option value="0"></option>
  <option value="Adventure">Adventure</option>
  <option value="Sci-fi">Sci-fi</option>
  <option value="Romance">Romance</option>
</select>
</p>

<p>Category:
<select id="category" name="category">                      
  <option value="0"></option>
  <option value="Movie">Movie</option>
  <option value="TV-series">TV-series</option>
</select>
</p>

<p>Language:
<select id="language" name="language">                      
  <option value="0"></option>
  <option value="English">English</option>
  <option value="Swedish">Swedish</option>
</select>
</p>

<p>Minimum rating:
<select id="rating" name="rating">                      
  <option value="0"></option>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">2</option>
  <option value="4">2</option>
  <option value="5">2</option>
</select>
</p>

<p>
    <input type="submit" name="submit" value="Search" />
</p>
    
</form>
</body>
</html>