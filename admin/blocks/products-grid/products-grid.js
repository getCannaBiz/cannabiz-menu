(function (blocks, element, components, editor) {
    var el = wp.element.createElement;
    var InnerBlocks = editor.InnerBlocks;
    var PanelBody = components.PanelBody;
    var SelectControl = components.SelectControl;
    var RangeControl = components.RangeControl;
    var CheckboxControl = components.CheckboxControl;
    var useState = wp.element.useState;
    var useEffect = wp.element.useEffect;
    var { useSelect, dispatch } = wp.data;

    function fetchPosts(postCount, setPreviewContent, showFeaturedImage, showExcerpt, category, setAttributes) {
        var apiUrl = '/wp-json/wpd/v1/products?per_page=' + postCount;

            // Fetch posts without specifying the category
            fetchPostsFromApi(apiUrl);

        function fetchPostsFromApi(apiUrl) {
            fetch(apiUrl)
                .then(function (response) {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(function (posts) {

                    var postsArray = Object.values(posts);

                    var postPromises = postsArray.map(function (post) {
                        return post;
                    });

                    Promise.all(postPromises).then(function(images) {
                        var postsArray = Object.values(images);
                        var previewContent = postsArray.map(function (post, index) {
                            var content = [];
                    
                            if (post) {
                                content.push(
                                    el('div', { className: 'list-content' },
                                        el('h3', {},
                                            el('a', { href: post.link }, post.title) // Rendering post.title and post.link
                                        ),
                                    )
                                );
                            }
                    
                            return content;
                        });
                    
                        setPreviewContent(previewContent);
                        setAttributes({ previewContent: previewContent });
                    });
                    
                })
                .catch(function (error) {
                    console.error('Error fetching posts:', error);
                    setPreviewContent([]);
                });
        }
    }

    blocks.registerBlockType('wp-dispensary/products', {
        title: 'Dispensary Products',
        icon: 'format-aside',
        category: 'common',
        attributes: {
            postCount: {
                type: 'number',
                default: 6
            },
            displayStyle: {
                type: 'string',
                default: 'grid'
            },
            showFeaturedImage: {
                type: 'boolean',
                default: true
            },
            showExcerpt: {
                type: 'boolean',
                default: true
            },
            category: {
                type: 'string',
                default: ''
            },
            previewContent: {
                type: 'array',
                default: []
            }
        },
        edit: function (props) {
            var attributes = props.attributes;
            var setAttributes = props.setAttributes;

            var [previewContent, setPreviewContent] = useState(attributes.previewContent);
            var [category, setCollection] = useState('');

            useEffect(() => {
                fetchPosts(attributes.postCount, setPreviewContent, attributes.showFeaturedImage, attributes.showExcerpt, category, setAttributes);
            }, [category, attributes.postCount, attributes.showFeaturedImage, attributes.showExcerpt]);

            function fetchCollections() {
                var apiUrl = '/wp-json/wp/v2/wpd_categories';

                fetch(apiUrl)
                    .then(function (response) {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(function (categories) {
                        var categoryOptions = categories.map(function (category) {
                            return { value: category.slug, label: category.name };
                        });

                        setCollectionOptions(categoryOptions);
                    })
                    .catch(function (error) {
                        console.error('Error fetching categories:', error);
                        setCollectionOptions([]);
                    });
            }

            var [categoryOptions, setCollectionOptions] = useState([]);
            useEffect(fetchCollections, []);

            function onChangePostCount(value) {
                setAttributes({ postCount: value });
                fetchPosts(value, setPreviewContent, attributes.showFeaturedImage, attributes.showExcerpt, category);
            }

            function onChangeDisplayStyle(value) {
                setAttributes({ displayStyle: value });
            }

            function onChangeShowFeaturedImage(value) {
                setAttributes({ showFeaturedImage: value });
                fetchPosts(attributes.postCount, setPreviewContent, value, attributes.showExcerpt, category);
            }

            function onChangeShowExcerpt(value) {
                setAttributes({ showExcerpt: value });
                fetchPosts(attributes.postCount, setPreviewContent, attributes.showFeaturedImage, value, category);
            }

            function onChangeCollection(value) {
                setAttributes({ category: value });
                setCollection(value);
            }

            var blockClassName = 'wpd-block-' + attributes.displayStyle;

            return el('div', { className: props.className },
                el(wp.blockEditor.InspectorControls, null,
                    el(PanelBody, { title: 'Product Block Settings', initialOpen: true },
                        el(RangeControl, {
                            label: 'Post Count',
                            value: attributes.postCount,
                            onChange: onChangePostCount,
                            min: 1,
                            max: 24
                        }),
                        el(SelectControl, {
                            label: 'Display Style',
                            value: attributes.displayStyle,
                            onChange: onChangeDisplayStyle,
                            options: [
                                { value: 'list', label: 'List' },
                                { value: 'grid', label: 'Grid' }
                            ]
                        }),
                        el(SelectControl, {
                            label: 'Collection',
                            value: attributes.category,
                            onChange: onChangeCollection,
                            options: [
                                { value: '', label: 'All' }, // Option to fetch all posts without specifying a category
                                ...categoryOptions
                            ]
                        }),
                        el(CheckboxControl, {
                            label: 'Show Featured Image',
                            checked: attributes.showFeaturedImage,
                            onChange: onChangeShowFeaturedImage
                        }),
                        el(CheckboxControl, {
                            label: 'Show Excerpt',
                            checked: attributes.showExcerpt,
                            onChange: onChangeShowExcerpt
                        })
                    )
                ),
                el('div', { className: blockClassName },
                    previewContent.map(function (content, index) {
                        return el('div', { className: 'wpd-block-post', key: index }, content);
                    })
                )
            );
        },
        save: function (props) {
            var attributes = props.attributes;
            var blockClassName = 'wpd-block-' + attributes.displayStyle;

            return el('div', { className: props.className },
                el('div', { className: blockClassName },
                    attributes.previewContent.map(function (content, index) {
                        return el('div', { className: 'product-block', key: index }, content);
                    })
                )
            );
        }        
    });
})(window.wp.blocks, window.wp.element, window.wp.components, window.wp.editor);