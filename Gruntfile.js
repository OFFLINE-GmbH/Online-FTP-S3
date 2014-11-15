module.exports = function (grunt) {

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        concat: {
            js: {
                src: [
                    'webroot/src/js/html5shiv.min.js',
                    'webroot/src/js/cookie.js',
                    'webroot/src/js/jquery.tablesorter.min.js',
                    'webroot/src/js/jquery.filtertable.min.js',
                    'webroot/src/js/mediathek.js',
                    'webroot/src/js/app.js'
                ],
                dest: 'webroot/src/js/concatinated.js'
            },
            css: {
                src: [
                    'webroot/src/css/fontello.min.css',
                    'webroot/src/css/main.min.css'
                ],
                dest: 'webroot/build/styles.min.css'
            }
        },
        uglify: {
            js: {
                files: {
                    'webroot/build/app.min.js': ['webroot/src/js/concatinated.js']
                }
            }
        },
        watch: {
            options: {
                livereload: true
            },
            scripts: {
                files: ['webroot/src/js/*.js'],
                tasks: ['concat', 'uglify', 'clean'],
                options: {
                    spawn: false
                }
            },
            css: {
                files: ['webroot/src/scss/*.scss', 'webroot/src/scss/**/*.scss'],
                tasks: ['sass:backend', 'concat'],
                options: {
                    spawn: false
                }
            }
        },
        sass: {
            backend: {
                options: {
                    'sourcemap=none': true,
                    style: 'compressed'
                },
                files: {
                    'webroot/src/css/main.min.css': 'webroot/src/scss/main.scss',
                    'webroot/src/css/fontello.min.css': 'webroot/src/fontello/css/cdc-embedded.css'
                }
            }
        },
        clean: {
            js: ['webroot/src/js/concatinated.js'],
            css: ['webroot/src/css/fontello.min.css', 'webroot/src/css/main.min.css']
        }
    });

    // 3. Where we tell Grunt we plan to use this plug-in.
    require('load-grunt-tasks')(grunt);

    // 4. Where we tell Grunt what to do when we type "grunt" into the terminal.
    grunt.registerTask('default', ['concat:js', 'uglify', 'sass:backend', 'concat:css', 'clean']);
    grunt.registerTask('dev', ['watch']);

};