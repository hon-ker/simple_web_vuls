<!DOCTYPE html>
<html>

<head>
	<title>文件上传</title>
	<meta charset="utf-8">
	<style>
		body {
			padding: 10px;
			max-width: 30em;
			margin: 0 auto;
			font-family: "Joe Font", "Helvetica Neue", Helvetica, "PingFang SC", "Hiragino Sans GB", "Microsoft YaHei", "微软雅黑", Arial, "sans-serif";
		}

		* {
			font-size: 16px;
			margin-bottom: 10px;
		}

		a {
			text-decoration: none;
			font-size: 16px;
		}

		img {
			width: 100%;
			border-radius: 4px;
		}

		.logo {
			background-color: #9999ff;
			color: white;
			font-size: 54px;
			font-style: italic;
			font-weight: 800;
			padding: 30px 20px;
			border-radius: 4px;
			text-align: center;
		}

		.submit {
			display: block;
			width: 100%;
		}

		.file-list {
			margin-top: 30px;

		}

		.file-list ul * {
			font-size: 18px;

		}
	</style>
</head>

<body>
	<div class="logo">文件上传</div>
	<!-- 上传form -->
	<form action="index.php" method="post" enctype="multipart/form-data">
		<input type="file" name="file">
		<input type="submit" value="上传" name="submit" class="submit">
		<?php
		// Check if the form was submitted and the file was uploaded
		if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
			// 获取文件名
			$filename = $_FILES['file']['name'];
			// 获取文件临时路径
			$temp_name = $_FILES['file']['tmp_name'];
			echo "<hr/>";

			// 将文件从临时路径移动到磁盘
			if (file_exists($filename)) {
				echo "<p>" . $filename . " 已存在!</p>";
			} else {
				move_uploaded_file($temp_name, $filename);
			}
		}

		?>

	</form>
	<!-- 文件列表 -->
	<div class="file-list">
		<h1>文件列表 /</h1>
		<ul>
			<?php
			// 输出所有文件和文件夹名
			$files = scandir('.');

			foreach ($files as $file) {
				if ($file != "." && $file != "..") {
					echo '<li><a href="' . $file . '">' . $file . '</a></li>';
				}
			}
			?>
		</ul>

	</div>

</body>

</html>