# Schema

## `roles`

### Columns

* `role_id` varchar(36) - Uuid version.
* `role_name` varchar(100) - Role name.

## `resources`

### Columns

* `resource_id` varchar(36) - Uuid version.
* `resource_name` varchar(100) - Laravel route prefixes.
* `resource_action` varchar(100) - Laravel routes.

## `roles_resources`

Many (`roles`) to Many (`resources`)

### Columns

* `role_id` - `roles`.`role_id`
* `resource_id` - `resources`.`resource_id`

## Other Tables

### `user_group` needs RBAC

Add `role_id` column to `user_group` which is related to `roles`.`role_id`.
