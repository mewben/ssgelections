module.exports = function(grunt) {
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		less: {
			dev: {
				files: {
					"public/assets/css/admin.css": "public/assets/less/admin.less",
					"public/assets/css/print.css": "public/assets/less/print.less"
				},
				options: { yuicompress: true }
			}
		},

		cssmin: {
			css: {
				files: {
					"public/assets/css/admin.min.css": "public/assets/css/admin.css",
					"public/assets/css/print.min.css": "public/assets/css/print.css"
				},
				options: {
					keepSpecialComments: 0
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
	grunt.loadNpmTasks('grunt-contrib-watch');

	grunt.registerTask('default', [
		'less:dev',
		'cssmin:css'
	]);
};