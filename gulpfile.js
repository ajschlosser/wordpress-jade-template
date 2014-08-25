/*
* Base Gulp.js workflow
* for simple front-end projects
* author: Aaron John Schlosser
* url: http://www.aaronschlosser.com
*/

var gulp 				= require("gulp"),
	gutil 				= require("gulp-util"),
	concat				= require("gulp-concat"),
	watch 				= require("gulp-watch"),
	compass 			= require("gulp-compass"),
	jade 				= require("gulp-jade-php"),
	plumber				= require("gulp-plumber")

var paths = {
	styles: {
		src: "./scss/**/*.scss",
		dest: "./stylesheets"
	},
	templates: {
		src: "./templates/**/*.jade",
		dest: "./"
	}
};

gulp.task("styles", function() {
	return gulp.src(paths.styles.src)
		.pipe(plumber())
		.pipe(compass({
			css: "./stylesheets",
			sass: "./scss",
			image: "./images"
		}))
		.pipe(plumber.stop())
		.pipe(gulp.dest(paths.styles.dest));
});

gulp.task("templates", function() {
  gulp.src("./templates/**/*.jade")
  	.pipe(plumber())
	.pipe(jade())
	.pipe(plumber.stop())		
	.pipe(gulp.dest("./"));
});

gulp.task("default", function() {
	gulp.watch(paths.styles.src, ["styles"]);
	gulp.watch(paths.templates.src, ["templates"]);
});