# Git Workflow

This document provides an overview of the Git workflow that is being used by the SFML team. If you are not a team member and want to contribute code, refer to the [Contribution Guidelines](contribute.md "Go to the contribution guidelines") instead.

## General Workflow

- Branch [`master`](https://github.com/SFML/SFML/tree/master) is used for active development.
- Create a branch `feature/name` or `bugfix/name` for every new feature or bugfix respectively, where `name` is a descriptive name using the `under_scores` convention.
- Create a pull request for every branch that you want merged into [`master`](https://github.com/SFML/SFML/tree/master).
- Reviewed and tested pull requests will be merged into [`master`](https://github.com/SFML/SFML/tree/master).
- Releases receive a [tag](https://github.com/SFML/SFML/tags) in form of the version number (x.y.z).

## Backporting

Critical bugs are fixed in [`master`](https://github.com/SFML/SFML/tree/master) and pushed out as a bugfix release with an increased patch version number. Starting from SFML 3, these modifications must be applied to the latest minor version of the previous major version as well.

The workflow is as follows:

- Fix bug in master (see [General Workflow](#general)).
- Branch off of the older release and cherry-pick the bugfix commits, using the `-x` flag to include a "(cherry-picked from...)" message.
- Create a tag with an increased patch version number.

## Examples

### Feature

1. Develop feature.
2. Clean up commits (squash and rebase onto [`master`](https://github.com/SFML/SFML/tree/master) if necessary).
3. Push to `feature/airplane`.
4. Create pull request.
5. Let others review and test it.
6. If okay it will be merged into [`master`](https://github.com/SFML/SFML/tree/master).
7. Delete `feature/airplane`.

### Bugfix

1. Develop bugfix.
2. Clean up commits (squash and rebase onto [`master`](https://github.com/SFML/SFML/tree/master) if necessary).
3. Push to `bugfix/window_shrinking`.
4. Create pull request.
5. Let others review and test it.
6. If okay it will be merged into [`master`](https://github.com/SFML/SFML/tree/master).
7. Delete `bugfix/window_shrinking`.
8. If this is a critical bug which leads to a bugfix release, backport the commit(s) (see [Backporting](https://www.sfml-dev.org/workflow.php#backporting)). Let's say we have versions 2.x.0 (latest release of SFML 2) and 3.1.1, where the latter is a bugfix release. The changes in 3.1.1 are then backported to 2.x.1.

### Release

1. Test current [`master`](https://github.com/SFML/SFML/tree/master) code on all supported platforms.
2. Clean up if necessary.
3. Tag last commit with new version number.
4. Release.
5. Happiness!