'use strict';

module.exports = function(grunt) {
  require('load-grunt-tasks')(grunt);

  grunt.initConfig({
    dirs: {
      public: 'src/main/public',
      scss: 'src/main/scss'
    },
    clean: [
      '.sass-cache',
      '<%= dirs.public %>/css/'
    ],
    sass: {
      options: {
        includePaths: [
          'node_modules/bootstrap-sass/assets/stylesheets'
        ],
      },
      dev: {
        files: {
          '<%= dirs.public %>/css/style.css': '<%= dirs.scss %>/style.scss'
        },
        options: {
          outputStyle: 'expanded',
          sourceMap: true
        }
      },
      dist: {
        files: {
          '<%= dirs.public %>/css/style.css': '<%= dirs.scss %>/style.scss'
        },
        options: {
          outputStyle: 'compressed',
          sourceMap: false
        }
      }
    }
  });

  grunt.registerTask('build', [
    'clean',
    'sass:dist'
  ]);

  grunt.registerTask('dev', [
    'clean',
    'sass:dev'
  ]);

  grunt.registerTask('default', [
    'build'
  ]);
};
