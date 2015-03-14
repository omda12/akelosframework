# Contributing #

Tickets are fine, but patches are great. If you want to change something in the Akelos Framework or fix a bug you've run across, there's no faster way to make it happen than to do it yourself.

## Get the Akelos Framework ready for patching ##
  * Check out the trunk using: "_svn checkout http://akelosframework.googlecode.com/svn/trunk/ akelos_"
  * Setup your environment in a way to be able to run the unit tests.
## Make a test-driven change ##
  * Add or change unit tests that would prove that your change worked.
  * Make the change to the source.
  * Verify that all existing tests still work as well as all the new ones you added by running ./script/test unit and ./script/test path\_to\_your\_test.php
## Share your well-tested change ##
  * Create a patch with your changes: svn diff > my\_properly\_named\_patch.diff
  * [Create a new ticket](http://code.google.com/p/akelosframework/issues/entry) with [_PATCH_] as the first word in the summary and upload (not paste) your diff.
  * Keep an eye on your patch in case there are any reservations raised before it can be applied.

Please make sure you read the [Akelos Framework coding guidelines](http://akelos.org/Akelos%20Framework%20Developer%20Coding%20Style%20Guide.pdf) before writing **large components** for the Framework



