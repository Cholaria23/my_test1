var gulp         = require('gulp'),
    svgstore     = require("gulp-svgstore");

gulp.task("svg", function () {
    return gulp
        .src("./resources/assets/frontend/svg/*.svg", { base: "./public/frontend/img/sprite" })
        .pipe(svgstore())
        .pipe(gulp.dest("./public/frontend/img"));
});
