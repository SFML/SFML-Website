from mkdocs.plugins import event_priority

# Low priority to run after mkdocs-static-i18n and be ready to check the current build language.
@event_priority(-100)
def on_config(config):
    """
    Prevent non-localized 403 and 404 error pages from being overwritten during
    non-default language builds, which would otherwise leave them with the
    localized navigation bar of the last language built.
    """
    if not config.plugins["i18n"].is_default_language_build:
        config.theme.static_templates -= {"403.html", "404.html"}

    return config
