const appName = 'vue-users'

import editMixin from './mixins/edit'
import helpersMixin from './mixins/helpers'

if (jQuery('#' + appName).length > 0) {
    new Vue({
        el: '#' + appName,
        mixins: [editMixin, helpersMixin],

        data: {
            errors: null,

            rolesJson: JSON.constructor([]),
        },

        computed: {
            rolesJsonString() {
                return JSON.stringify(this.rolesJson)
            },
        },

        methods: {
            roleIdIsAssigned(id) {
                let $this = this
                var roleId

                for (roleId in $this.rolesJson) {
                    if ($this.rolesJson.hasOwnProperty(roleId)) {
                        if ($this.rolesJson[roleId].id == id) return roleId
                    }
                }

                return false
            },

            f_add() {
                let $this = this

                let allRoles = document.getElementById('all-roles')

                if (
                    !$this.roleIdIsAssigned(
                        allRoles.options[allRoles.selectedIndex].value,
                    )
                ) {
                    //noinspection JSJQueryEfficiency
                    $('#assigned-roles').append(
                        '<option value=' +
                            $('#all-roles')
                                .children('option:selected')
                                .val() +
                            '>' +
                            $('#all-roles')
                                .children('option:selected')
                                .text() +
                            '</option>',
                    )

                    $this.rolesJson.push({
                        id: allRoles.options[allRoles.selectedIndex].value,
                        name: allRoles.options[allRoles.selectedIndex].text,
                    })
                }
            },

            f_remove() {
                let $this = this

                //noinspection JSJQueryEfficiency
                let id = $('#assigned-roles')
                    .children('option:selected')
                    .val()

                if ($this.roleIdIsAssigned(id)) {
                    //noinspection JSJQueryEfficiency
                    $('#assigned-roles')
                        .find('[value="' + id + '"]')
                        .remove()

                    $this.rolesJson.splice($this.roleIdIsAssigned(id), 1)
                }
            },

            submitForm() {
                let form = document.getElementById('formUsers')
                form.submit()
            },
        },

        mounted: function() {
            let $this = this
            var i

            let assignedRoles = document.getElementById('assigned-roles')
            for (i = 0; i < assignedRoles.options.length; i++) {
                $this.rolesJson.push({
                    id: assignedRoles[i].value,
                    name: assignedRoles[i].text,
                })
            }

            console.log($this.rolesJsonString)
        },
    })
}
