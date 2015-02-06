module.exports = function (grunt) {
    'use strict';
    // Project configuration
    grunt.initConfig({
        // Metadata
        pkg: grunt.file.readJSON('package.json'),
        banner: '/*! <%= pkg.name %> - v<%= pkg.version %> - ' +
            '<%= grunt.template.today("yyyy-mm-dd") %>\n' +
            '<%= pkg.homepage ? "* " + pkg.homepage + "\\n" : "" %>' +
            '* Copyright (c) <%= grunt.template.today("yyyy") %> <%= pkg.author.name %>;' +
            ' Licensed <%= props.license %> */\n',
        phpunit: {
            configuration: 'phpunit.xml',
            options: {
                bin: './vendor/bin/phpunit',
                colors: true
            }
        }
    });

    // These plugins provide necessary tasks
    grunt.loadNpmTasks('grunt-phpunit');

    // Default task
    grunt.registerTask('default', [
        'phpunit'
    ]);
};