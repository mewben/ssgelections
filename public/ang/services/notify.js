angular.module('ssg')
    .factory('Notify', [
        function () {

        return {
            successCallback: function (msg) {
                msg = typeof msg !== 'undefined' ? msg : "Operation Successful.";
                toastr.success(msg, 'Success');
            },

            errorCallback: function (err) {
                var d = '';
                if(typeof err.data == 'object') {
                    for (var key in err.data) {
                        if(err.data.hasOwnProperty(key)) {
                            d += '<li>' + err.data[key][0] + '</li>';
                        }
                    }
                } else if (err.data) {
                    d += '<li>' + err.data + '</li>';
                } else {
                    d += '<li>' + err + '</li>';
                }
                toastr.error('<ul>' + d + '</ul>', 'Oops!');
            }
        };
    }]);
