/*
* Base Gulp.js workflow
* for simple front-end projects
* author: Aaron John Schlosser
* url: http://www.aaronschlosser.com
*/

var gulp 				= require("gulp"),
	gutil 				= require("gulp-util"),
	uglify 				= require("gulp-uglify"),
	concat				= require("gulp-concat"),
	watch 				= require("gulp-watch"),
	compass 			= require("gulp-compass"),
	jade 				= require("gulp-jade-php"),
	minifyCSS 			= require("gulp-minify-css"),
	plumber				= require("gulp-plumber"),
	imagemin 			= require("gulp-imagemin");

var paths = {
	scripts: {
		src: ["./js/**/*.js", "!./js/**/*.min.js"],
		dest: "./js",
		con: "all.min.js"
	},
	styles: {
		src: "./sass/**/*.scss",
		dest: "./stylesheets"
	},
	templates: {
		src: "./templates/**/*.jade",
		dest: "./"
	},
	images: {
		src: "./images/**/*",
		dest: "./images"
	}
};

gulp.task("scripts", function() {
  return gulp.src(paths.scripts.src)
  	.pipe(plumber())
	.pipe(uglify())
	.pipe(concat(paths.scripts.con))
	.pipe(plumber.stop())
	.pipe(gulp.dest(paths.scripts.dest))
});

gulp.task("styles", function() {
  return gulp.src(paths.styles.src)
  .pipe(plumber())
  .pipe(compass({
	css: "./stylesheets",
	sass: "./sass",
	image: "./images"
  }))
  .pipe(minifyCSS())
  .pipe(plumber.stop())
  .pipe(gulp.dest(paths.styles.dest));
});

gulp.task("templates", function() {
  gulp.src("./templates/**/*.jade")
  	.pipe(plumber())
	.pipe(jade({
		locals: {
		  title: "OMG THIS IS THE TITLE"
		}
	 }))
	.pipe(plumber.stop())		
	.pipe(gulp.dest("./"));
});

gulp.task("imagemin", function () {
	return gulp.src("./images/*.*")
		.pipe(plumber())
		.pipe(imagemin())
		.pipe(plumber.stop())
		.pipe(gulp.dest("./images"));
});


gulp.task("default", function() {
	gulp.watch(paths.scripts.src, ["scripts"]);
	gulp.watch(paths.styles.src, ["styles"]);
	gulp.watch(paths.images.src, ["imagemin"]);
	gulp.watch(paths.templates.src, ["templates"]);
});