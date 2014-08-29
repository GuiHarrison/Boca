module.exports = function (grunt) {
  // Configure grunt
  grunt.initConfig({
    sprite:{
      all: {
        src: 'img/sprites/*.png',
        algorithm: 'binary-tree',
        destImg: 'img/spritesheet.png',
        destCSS: 'img/sprites/sprites.css'
      }
    },

    sass: {
      dist: {
        options: {
          style: 'compressed',
          noCache: 'true'
        },
        files: {
          'style.css' : 'style.scss'
        }
      }
    },

    watch: {
      css: {
        files: '**/*.scss',
        tasks: ['sass']
      }
    },

    imageoptim: {
      myTask: {
        src: ['img']
      }
    },

    jshint: {
      all: ['Gruntfile.js', 'js/*.js']
    },

    uncss: {
	  dist: {
	    src: ['style.css'],
	    dest: 'style.min.css',
	    options: {
	      report: 'min' // optional: include to report savings
	    }
	  }
	}

  });

  // Load in `grunt-spritesmith`
  grunt.loadNpmTasks('grunt-spritesmith');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-imageoptim');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-uncss');
  // Default task(s).
  grunt.registerTask('default',['sprite','watch','imageoptim','jshint','uncss']);

};