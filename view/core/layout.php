<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Layout</title>
</head>
<body>
	<table>
		<td>
			<tr><?php $this->getHeader()->toHtml();?></tr>
		</td>

		<td>
			<tr><?php $this->getFooter()->toHtml();?> </tr>
		</td>

		<td>
			<tr><?php $this->getContent()->toHtml();?> </tr>
		</td>
	</table>
</body>
</html>