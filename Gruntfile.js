module.exports = function(grunt) {
var deploy_to = grunt.option('path') || false;
grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    clean: {
        dist: {
            src: ['dist'],
        },
        css: {
            src: ['css'],
        },
        js: {
            src: ['js'],
        },
        favicons: {
            src: ['favicons', 'partials/favicons.php'],
        },
    },

    compass: {
        dist: {
            options: {
                config: 'compass.rb',
                sassDir: 'sass',
                cssDir: 'css',
                environment: 'production',
                outputStyle: 'expanded',
            },
        },
    },

    copy: {
        dist: {
            expand: true,
            cwd: '.',
            src: ['**', '!.**', '!img/favicon.source.png', '!node_modules/**', '!sass/**', '!src/**', '!bower.json', '!compass.rb', '!Gruntfile.js', '!package.json'],
            dest: 'dist/',
        },
    },

    cssmin: {
        options: {
            keepSpecialComments: 0,
        },
        target: {
            files: [{
                expand: true,
                cwd: 'css',
                src: ['**/*.css', '!**/*.min.css'],
                dest: 'css',
                ext: '.min.css',
            }],
        },
    },

    favicons: {
        options: {
            html: 'partials/favicons.php',
            HTMLPrefix: '<?php echo get_stylesheet_directory_uri(); ?>/favicons/',
            precomposed: false,
            tileBlackWhite: false,
        },
        icons: {
            src: 'img/favicon.source.png',
            dest: 'favicons',
        },
    },

    imagemin: {
        dynamic: {
            files: [{
                expand: true,
                cwd: 'img/',
                src: ['*.{png,jpg,gif}'],
                dest: 'img/',
            }],
        },
    },

    modernizr: {
        dist: {
            "crawl": false,
            "customTests": [],
            "dest": "js/modernizr.min.js",
            "tests": [
                "borderimage"
            ],
            "options": [
                "setClasses"
            ],
            "uglify": true
        }
    },

    postcss: {
        options: {
            map: true,
            processors: [
                require('pixrem')(),
                require('autoprefixer')({browsers: '> 1%, last 3 versions'}),
            ],
        },
        dist: {
            src: 'css/*.css'
        }
    },

    rsync: {
        options: {
            args: ['-avzh', '--stats', '--delete'],
        },
        prod: {
            options: {
                src: './dist/',
                dest: deploy_to,
            },
        },
    },

    uglify: {
        options: {
            mangle: false,
            compress: true,
        },
        target: {
            files: [{
                expand: true,
                cwd: 'src',
                src: ['**/*.js', '!**/*.min.js'],
                dest: 'js',
                ext: '.min.js',
            }],
        },
    },

    watch: {
        options: {
            livereload: true,
        },
        php: {
            files: '**/*.php',
            tasks: [],
        },
        favicon: {
            files: 'img/favicon.source.png',
            tasks: ['favicons'],
        },
        less: {
            files: 'sass/*.scss',
            tasks: ['css'],
        },
        js: {
            files: 'src/*.js',
            tasks: ['uglify'],
        },
    },
});

    // Plugins
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-compass');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-imagemin');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-favicons');
    grunt.loadNpmTasks('grunt-modernizr');
    grunt.loadNpmTasks('grunt-postcss');
    grunt.loadNpmTasks('grunt-rsync');


    // Tasks
    grunt.registerTask('default', ['build']);

    grunt.registerTask('images', [
        'imagemin',
        'favicons'
    ]);
    grunt.registerTask('css', [
        'compass',
        'postcss',
        'cssmin'
    ]);
    grunt.registerTask('js', [
        'modernizr',
        'uglify'
    ]);
    grunt.registerTask('build', [
        'clean',
        'images',
        'css',
        'js'
    ]);
    grunt.registerTask('dist', [
        'build',
        'copy'
    ]);
    grunt.registerTask('deploy', ['rsync']);
};
