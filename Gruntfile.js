module.exports = function (grunt) {

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        autoprefixer: {
            options: {
                browsers: ['last 4 versions', 'ie 8', 'ie 9']
            },
            main: {
                src: 'public/assets/src/css/main.unprefixed.css',
                dest: 'public/assets/src/css/main.min.css'
            }
        },

        concat: {
            //js: {
            //    src: [
            //        'public/assets/src/js/html5shiv.min.js',
            //        'public/assets/src/js/cookie.js',
            //        'public/assets/src/js/jquery.tablesorter.min.js',
            //        'public/assets/src/js/jquery.filtertable.min.js',
            //        'public/assets/src/js/mediathek.js',
            //        'public/assets/src/js/app.js'
            //    ],
            //    dest: 'public/assets/src/js/concatinated.js'
            //},
            css: {
                src: [
                    'public/assets/src/css/fontello/css/onlineftp-embedded.css',
                    'public/assets/src/css/main.min.css'
                ],
                dest: 'public/assets/build/styles.min.css'
            }
        },
        //uglify: {
        //    js: {
        //        files: {
        //            'public/assets/build/app.min.js': ['public/assets/src/js/concatinated.js']
        //        }
        //    }
        //},
        watch: {
            options: {
                livereload: true
            },
            scripts: {
                files: ['public/assets/src/js/*.js', 'public/app/**/*.js'],
                tasks: ['concat:js', 'clean:js'],
                options: {
                    spawn: false
                }
            },
            css: {
                files: ['public/assets/src/scss/*.scss', 'public/assets/src/scss/**/*.scss'],
                tasks: ['sass:assets','autoprefixer', 'concat'],
                options: {
                    spawn: false
                }
            }
        },
        sass: {
            assets: {
                options: {
                    'sourcemap=none': true,
                    style: 'compressed'
                },
                files: {
                    'public/assets/src/css/main.unprefixed.css': 'public/assets/src/scss/main.scss',
                    // 'public/assets/src/css/fontello.min.css': 'public/assets/src/fontello/css/cdc-embedded.css'
                }
            }
        },
        clean: {
            js: ['public/assets/src/js/concatinated.js'],
            css: ['public/assets/src/css/fontello.min.css', 'public/assets/src/css/main.min.css', 'public/assets/src/css/main.unprefixed.css']
        }
    });

    // 3. Where we tell Grunt we plan to use this plug-in.
    require('load-grunt-tasks')(grunt);

    // 4. Where we tell Grunt what to do when we type "grunt" into the terminal.
    // grunt.registerTask('default', ['concat:js', 'uglify', 'sass:assets', 'concat:css', 'clean']);
    grunt.registerTask('default', ['sass:assets', 'autoprefixer', 'concat:css', 'clean']);
    grunt.registerTask('dev', ['watch']);

};