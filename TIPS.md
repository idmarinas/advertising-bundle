# Useful Tips

> Workflows that would otherwise be triggered using `on: push` or `on: pull_request` won't be triggered if you add
> any of the following strings to the commit message in a push, or the HEAD commit of a pull request:
> * `[skip ci]`
> * `[ci skip]`
> * `[no ci]`
> * `[skip actions]`
> * `[actions skip]`
