define(['jquery', 'core/ajax'], function($, Ajax) {
    return {
        init: function(updateUrl) {
            $('body').on('change', '.task-checkbox', function() {
                var taskId = $(this).data('task-id');
                var completed = $(this).prop('checked');

                Ajax.call([{
                    methodname: 'block_check_list_update_task_status',
                    args: { taskid: taskId, completed: completed },
                    done: function(response) {
                        console.log(response.status);
                    },
                    fail: function(error) {
                        console.error('Error updating task status:', error);
                    }
                }]);
            });
        }
    };
});