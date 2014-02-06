module.exports = function(grunt) {
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		less: {
			dev: {
				files: {
					"public/assets/css/admin.css": "public/assets/less/admin.less"
				},
				options: { yuicompress: true }
			}
		},

		cssmin: {
			css: {
				files: {
					"public/assets/css/admin.min.css": "public/assets/css/admin.css"
				},
				options: {
					keepSpecialComments: 0
				}
			}
		}


	});

	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-cssmin');

	grunt.registerTask('default', [
		'less:dev',
		'cssmin:css'
	]);
};