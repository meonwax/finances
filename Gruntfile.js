'use strict';

module.exports = function(grunt) {
  require('load-grunt-tasks')(grunt);

  grunt.initConfig({
    dirs: {
      public: 'public',
      scss: 'scss'
    },
    clean: [
      '.sass-cache',
      '<%= dirs.public %>/css/'
    ],
    sass: {
      dev: {
        files: {
          '<%= dirs.public %>/css/style.css': '<%= dirs.scss %>/style.scss'
        },
        options: {
          style: 'expanded'
        }
      },
      dist: {
        files: {
          '<%= dirs.public %>/css/style.css': '<%= dirs.scss %>/style.scss'
        },
        options: {
          style: 'compressed',
          sourcemap: 'none'
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
