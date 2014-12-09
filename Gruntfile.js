module.exports = function (grunt) {

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        concat: {
            //js: {
            //    src: [
            //        'template/src/js/html5shiv.min.js',
            //        'template/src/js/cookie.js',
            //        'template/src/js/jquery.tablesorter.min.js',
            //        'template/src/js/jquery.filtertable.min.js',
            //        'template/src/js/mediathek.js',
            //        'template/src/js/app.js'
            //    ],
            //    dest: 'template/src/js/concatinated.js'
            //},
            css: {
                src: [
                    'template/src/css/fontello/css/onlineftp-embedded.css',
                    'template/src/css/main.min.css'
                ],
                dest: 'template/build/styles.min.css'
            }
        },
        //uglify: {
        //    js: {
        //        files: {
        //            'template/build/app.min.js': ['template/src/js/concatinated.js']
        //        }
        //    }
        //},
        watch: {
            options: {
                livereload: true
            },
            scripts: {
                files: ['template/src/js/*.js'],
                tasks: ['concat', 'uglify', 'clean'],
                options: {
                    spawn: false
                }
            },
            css: {
                files: ['template/src/scss/*.scss', 'template/src/scss/**/*.scss'],
                tasks: ['sass:template', 'concat'],
                options: {
                    spawn: false
                }
            }
        },
        sass: {
            template: {
                options: {
                    'sourcemap=none': true,
                    style: 'compressed'
                },
                files: {
                    'template/src/css/main.min.css': 'template/src/scss/main.scss',
                    // 'template/src/css/fontello.min.css': 'template/src/fontello/css/cdc-embedded.css'
                }
            }
        },
        clean: {
            js: ['template/src/js/concatinated.js'],
            css: ['template/src/css/fontello.min.css', 'template/src/css/main.min.css']
        }
    });

    // 3. Where we tell Grunt we plan to use this plug-in.
    require('load-grunt-tasks')(grunt);

    // 4. Where we tell Grunt what to do when we type "grunt" into the terminal.
    // grunt.registerTask('default', ['concat:js', 'uglify', 'sass:template', 'concat:css', 'clean']);
    grunt.registerTask('default', ['sass:template', 'concat:css', 'clean']);
    grunt.registerTask('dev', ['watch']);

};