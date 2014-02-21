module.exports = function(grunt) {
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		less: {
			dev: {
				files: {
					"public/assets/css/admin.css": "public/assets/less/admin.less",
					"public/assets/css/print.css": "public/assets/less/print.less",
					"public/assets/css/client.css": "public/assets/less/client.less"
				},
				options: { yuicompress: true }
			}
		},

		cssmin: {
			css: {
				files: {
					"public/assets/css/admin.min.css": "public/assets/css/admin.css",
					"public/assets/css/print.min.css": "public/assets/css/print.css",
					"public/assets/css/client.min.css": "public/assets/css/client.css"
				},
				options: {
					keepSpecialComments: 0
				}
			}
		},

		concat: {
			admin: {
				src: [
					'public/assets/js/angular-select2.js',
					'public/assets/js/select2.min.js',
					'public/assets/js/toastr.min.js',
					'public/assets/less/bootstrap-3.1.0/js/transition.js',
					'public/assets/less/bootstrap-3.1.0/js/dropdown.js',
					'public/assets/less/bootstrap-3.1.0/js/collapse.js',
					'public/assets/less/bootstrap-3.1.0/js/modal.js',
					'public/assets/less/bootstrap-3.1.0/js/tooltip.js',
					'public/assets/less/bootstrap-3.1.0/js/tab.js',
					'public/ang/init.js',
					'public/ang/app.js',
					'public/ang/services/api.js',
					'public/ang/services/notify.js',
					'public/ang/controllers.js',
					'public/ang/directives.js',
				],
				dest: 'public/assets/js/admin.js'
			}
		},

		uglify: {
			admin: {
				src: 'public/assets/js/admin.js',
				dest: 'public/assets/js/admin.min.js',
				options: {
					preserveComments: false
				}
			}
		},

		htmlhint: {
			partials: {
				options: {
					'tag-pair': true
				},
				src: 'public/ang/partials/**/*.html'
			}
		},

		htmlmin: {
			partials: {
				files: grunt.file.expandMapping(['public/ang/partials/**/*.html'], 'min/', {
					rename: function (destBase, destPath) {
						return destPath.replace('/partials/', '/partials-min/');
					}
				}),
				options: {
					removeComments: true,
					collapseWhitespace: true
				}
			}
		},

		watch: {
			assets: {
				files: [
					"public/assets/less/**/*.less",
					"public/assets/js/**/*.js"
				],
				tasks: ['less:dev']
			}
		}


	});

	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-htmlhint');
	grunt.loadNpmTasks('grunt-contrib-htmlmin');
	grunt.loadNpmTasks('grunt-contrib-watch');

	grunt.registerTask('default', [
		'less:dev',
		'cssmin:css',
		'concat:admin',
		'uglify:admin',
		'htmlhint:partials',
		'htmlmin:partials'
	]);
};