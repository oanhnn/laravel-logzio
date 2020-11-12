# Contribution Guide

Contributions are **welcome** and will be fully **credited**.

Please read and understand the contribution guide before creating an issue or pull request.

This project adheres to the following standards and practices.

## Versioning

This project is versioned under the [Semantic Versioning](http://semver.org/) guidelines as much as possible.

Releases will be numbered with the following format:

- `<major>.<minor>.<patch>`
- `<breaking>.<feature>.<fix>`

And constructed with the following guidelines:

- Breaking backward compatibility bumps the major and resets the minor and patch.
- New additions without breaking backward compatibility bump the minor and reset the patch.
- Bug fixes and misc changes bump the patch.


## Pull Requests

The pull request process differs for new features and bugs.

Pull requests for bugs may be sent without creating any proposal issue. If you believe that you know of a solution for a bug that has been filed, please leave a comment detailing your proposed fix or create a pull request with the fix mentioning that issue id.


## Coding Standards

This project follows the FIG PHP Standards Recommendations compliant with the [PSR-1: Basic Coding Standard](http://www.php-fig.org/psr/psr-1/), [PSR-12 Extended Coding Style](https://www.php-fig.org/psr/psr-12) and [PSR-4: Autoloader](http://www.php-fig.org/psr/psr-4/) to ensure a high level of interoperability between shared PHP code. If you notice any compliance oversights, please send a patch via pull request.


## Feature Requests

If you have a proposal or a feature request, you may create an issue with `[Proposal]` in the title.

The proposal should also describe the new feature, as well as implementation ideas. The proposal will then be reviewed and either approved or denied. Once a proposal is approved, a pull request may be created implementing the new feature.


## Git Flow

This project follows [Git-Flow](http://nvie.com/posts/a-successful-git-branching-model/), and as such has `master` (latest stable releases), `develop` (latest WIP development) and X.Y support branches (when there's multiple major versions).

Accordingly all pull requests MUST be sent to the `develop` branch.

> **Note:** Pull requests which do not follow these guidelines will be closed without any further notice.

## Etiquette

This project is open source, and as such, the maintainers give their free time to build and maintain the source code held within. They make the code freely available in the hope that it will be of use to other developers. It would be extremely unfair for them to suffer abuse or anger for their hard work.

Please be considerate towards maintainers when raising issues or presenting pull requests. Let's show the world that developers are civilized and selfless people.

It's the duty of the maintainer to ensure that all submissions to the project are of sufficient quality to benefit the project. Many developers have different skillsets, strengths, and weaknesses. Respect the maintainer's decision, and do not be upset or abusive if your submission is not used.

## Viability

When requesting or submitting new features, first consider whether it might be useful to others. Open source projects are used by many developers, who may have entirely different needs to your own. Think about whether or not your feature is likely to be used by other users of the project.

## Procedure

Before filing an issue:

- Attempt to replicate the problem, to ensure that it wasn't a coincidental incident.
- Check to make sure your feature suggestion isn't already present within the project.
- Check the pull requests tab to ensure that the bug doesn't have a fix in progress.
- Check the pull requests tab to ensure that the feature isn't already in progress.

Before submitting a pull request:

- Check the codebase to ensure that your feature doesn't already exist.
- Check the pull requests to ensure that another person hasn't already submitted the feature or fix.

**Happy coding**!
