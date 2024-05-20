# Contribution Guidelines

You would like to see a feature implemented or a bug fixed in SFML? Great! Contributions to SFML are highly appreciated, be it in the form of general ideas, concrete suggestions or code patches.

This document explains how you can contribute. By carefully reading it, you minimize the time it takes on your and on our side until a modification is implemented. Since we can't (and don't want to) implement everything, the following guidelines clarify what it takes for a contribution to be accepted.

## General Considerations

In case of any questions or doubt (and after reading all the available resources), feel free to ask on the forum. Before opening GitHub issues and/or pull requests, use the forum to discuss your matter.

### Scope

Contributions must fit into one of the following SFML modules:

- System
- Window
- Graphics
- Audio
- Network

That clearly rules out anything specifically related to game development. Such **counterexamples** are: Physics, collision detection/response, AI, path finding, 3D abstraction layer (like the current graphics module), file system, etc.

There are several reasons why SFML does not support these features:

- The API should be focused and of high quality. Instead of implementing a lot of features that are possible and sometimes even simple to implement, we consider it important that people have a clear view of what this library provides.
- For most of the listed points, there are existing libraries that have been developed over years and provide everything you need.
- Resources are limited. The time we would invest into other features can be used to improve and extend the existing multimedia library.
- How these features could be provided is controversial. Many of them are very specific and concrete implementations are often limited to a few use cases.
- Many features can be added as an extension. SFML works as an abstraction of low-level and platform-specific functionality to provide a portable API. Higher-level features do not have this requirement.

The rule of thumb is: If a feature can easily be added on top of SFML without modifying the core library, it is probably not a good candidate to be integrated.

### Code Style

Contributions in the form of code must follow our [**syntactical conventions**](style.md "Go to the style guide"). Before submitting a pull request, please make sure your commits really adhere to them. For design and semantics (e.g. "do I use a pointer or a reference", "what is the correct type here"), have a look at existing SFML source code.

### Philosophy

SFML has been developed under the following considerations, keep them in mind when contributing:

- **Simple.** Features are easy to use. Even more complex functionality should be provided in the most simple way possible, using abstraction where necessary.
- **Slim API.** Minimal APIs are preferred to bloated collections of functionality that try to fit everyone's needs. Especially when introducing new functionality, it is often a good idea to start with a small set of classes and functions. It can still be extended later.
- **Fast.** Performance-critical tasks are implemented efficiently. Readability and correctness take precedence though, and premature optimization is to be avoided.
- **Clean code.** Source code is well-structured, modular, readable and uses modern C++ idioms. Avoid clever hacks or micro-optimizations.
- **Pragmatic.** SFML does not attempt to solve every possible problem, instead it tries to offer functionality that is useful to a wide variety of users.

## Contributing

### Reporting bugs

1. Make sure it is really a bug and not a misunderstanding of what SFML is supposed to do. Check the [documentation](https://www.sfml-dev.org/documentation/latest/) again to be sure.
2. Make sure the bug has not already been reported. Check [the GitHub issues](https://github.com/SFML/SFML/issues?q=) and [the forum](http://en.sfml-dev.org/forums/index.php?action=search).
3. Use the [latest revision](https://github.com/SFML/SFML) from GitHub and check if the bug has not already been fixed. Refer to the [official tutorial](https://www.sfml-dev.org/tutorials/latest/compile-with-cmake.php) for information on how to build SFML yourself.
4. Open a new thread on the [forum](http://en.sfml-dev.org/forums/) in the appropriate help board and give the following information:
    - [A minimal and complete code example](http://en.sfml-dev.org/forums/index.php?topic=5559.msg36368#msg36368) that reproduces the bug as you are experiencing it.
    - Instructions for reproducing the bug if it isn't obvious when running the example.
    - Environment information (operating system, SFML version, compiler etc.).
    - Screenshots and/or videos, if necessary, to demonstrate certain behavior.
    - Anything else that helps identify the problem.

### Requesting features

If you have an idea for a new feature, and it's within SFML's scope (see above), create a proper thread on [the dedicated sub-forum](http://en.sfml-dev.org/forums/index.php?board=2.0).

A feature request should always contain a rationale for the change. Whenever you suggest a feature, argue from a user perspective: in which way is SFML limited? What use cases does the feature allow? How can other users benefit from the change?

### Testing

Testing is a crucial part of integrating new changes – the larger the number of people who help us, the faster we can proceed with development, and the quicker we can find and eliminate bugs.

Feel free to participate in forum discussions, GitHub issues or existing pull requests. You can also try out the latest changes in the master Git branch and report any issues that you might find back to us on the forum.

### Sending patches/pull requests

In general code is only accepted when a proper GitHub issue already exists (usually preceded by a forum discussion). Make sure that nobody else is already working on an issue, or simply offer help and wait for a response.

Patches are accepted through GitHub pull requests. These are the steps required to send in such a request:

1. [Fork SFML](https://github.com/SFML/SFML/fork).
2. Commit your changes and push them to your forked repository.
3. Create a [pull request](https://help.github.com/articles/creating-a-pull-request) that targets the _master_ branch.

In the pull request, provide the following information:

- Descriptive title.
- Concise description of the modification.
- Reference the GitHub issue that you implemented/fixed.
- Link to the forum thread where the discussion originated.
- [A minimal complete code example](http://en.sfml-dev.org/forums/index.php?topic=5559.msg36368#msg36368) that helps people to test the implementation. The idea is that anybody can test the functionality with minimal effort. If external files are needed, add a link to them.
- Bugfix: the code should reproduce the bug.
- Feature: show how the feature is used.

For smaller issues, a single commit should be attached to the pull request. If you implement a larger modification, you may split the commits, but please do so semantically ("implemented feature X, fixed bug Y") and not chronologically ("started X, continued Y, finished Z"). Keep in mind that in addition to adding new commits, you can also overwrite existing ones by force-pushing (`git push --force-with-lease`) to your repository branch.

We may ask you to elaborate and improve certain parts of your code, sometimes we also edit it directly. We consider it important that you are listed as a contributor in the SFML commit history, so make sure that you choose credentials (author name and e-mail address) that you want to be published.