module.exports = function (grunt) {

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        concat: {
            //js: {
            //    src: [
            //        'assets/src/js/html5shiv.min.js',
            //        'assets/src/js/cookie.js',
            //        'assets/src/js/jquery.tablesorter.min.js',
            //        'assets/src/js/jquery.filtertable.min.js',
            //        'assets/src/js/mediathek.js',
            //        'assets/src/js/app.js'
            //    ],
            //    dest: 'assets/src/js/concatinated.js'
            //},
            css: {
                src: [
                    'assets/src/css/fontello/css/onlineftp-embedded.css',
                    'assets/src/css/main.min.css'
                ],
                dest: 'assets/build/styles.min.css'
            }
        },
        //uglify: {
        //    js: {
        //        files: {
        //            'assets/build/app.min.js': ['assets/src/js/concatinated.js']
        //        }
        //    }
        //},
        watch: {
            options: {
                livereload: true
            },
            scripts: {
                files: ['assets/src/js/*.js'],
                tasks: ['concat', 'uglify', 'clean'],
                options: {
                    spawn: false
                }
            },
            css: {
                files: ['assets/src/scss/*.scss', 'assets/src/scss/**/*.scss'],
                tasks: ['sass:assets', 'concat'],
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
                    'assets/src/css/main.min.css': 'assets/src/scss/main.scss',
                    // 'assets/src/css/fontello.min.css': 'assets/src/fontello/css/cdc-embedded.css'
                }
            }
        },
        clean: {
            js: ['assets/src/js/concatinated.js'],
            css: ['assets/src/css/fontello.min.css', 'assets/src/css/main.min.css']
        }
    });

    // 3. Where we tell Grunt we plan to use this plug-in.
    require('load-grunt-tasks')(grunt);

    // 4. Where we tell Grunt what to do when we type "grunt" into the terminal.
    // grunt.registerTask('default', ['concat:js', 'uglify', 'sass:assets', 'concat:css', 'clean']);
    grunt.registerTask('default', ['sass:assets', 'concat:css', 'clean']);
    grunt.registerTask('dev', ['watch']);

};