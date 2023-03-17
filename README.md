# moodle-tool_mfa

* [What is this?](#what-is-this)
* [What is changed?](#what-is-changed)

## What is this?
This is a Fork of the [Third party MFA plugin](https://github.com/catalyst/moodle-tool_mfa) by Catalyst. This fork contains some alterations to the workings of the original plugin.


## What is changed
The major changes to the original plugin are:

* Moved the MFA check from the login authentication step to opening a course that has the course field "requires_mfa" set to true.
