# Bolt Social Media Extension
by Lulububu

## How-To

Add the socialmedia field to a contenttype. We suggest creating a singleton settings contenttype, which allows to set the social media fields globally:

```yaml
settings:
    name: Settings
    slug: settings
    singular_name: Settings
    singular_slug: settings
    viewless: true
    viewless_listing: true
    singleton: true
    icon_many: 'fa:cogs'
    icon_one: 'fa:cog'
    fields:
        socialmedia:
            type: socialmedia
            label: Social Media
            group: Social Media
```

Update the config, in case you adjusted the naming of the settings contenttype.  
You can also change the social media fields, in case you need to.

After that you can set your social medias in the settings.

## Usage

The social media fields are now added to the twig globals and can be used in your templates.

```twig
<ul>
    {% for name, social in socialmedia %}
        <li>
            <a
                href="{{ social }}"
                target="_blank"
                rel="noopener noreferrer"
            >
                {{- name -}}
            </a>
        </li>
    {% endfor %}
</ul>
```
