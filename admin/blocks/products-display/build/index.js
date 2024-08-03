import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody, SelectControl } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { useEffect, useState } from '@wordpress/element';
import apiFetch from '@wordpress/api-fetch';
import './style.css';

registerBlockType('wpd/product-display', {
    title: 'WP Dispensary Products',
    icon: 'grid-view',
    category: 'widgets',
    attributes: {
        selectedTaxonomy: {
            type: 'object',
            default: {
                strain_type: '',
                shelf_type: '',
                wpd_categories: '',
            },
        },
        columns: {
            type: 'number',
            default: 3,
        },
    },
    edit: ({ attributes, setAttributes }) => {
        const { selectedTaxonomy, columns } = attributes;
        const [taxonomyTerms, setTaxonomyTerms] = useState({});

        const { taxonomies } = useSelect(select => {
            return {
                taxonomies: select('core').getTaxonomies({ type: 'products' }),
            };
        }, []);

        useEffect(() => {
            const fetchTerms = async () => {
                const terms = {};
                for (const taxonomy of taxonomies) {
                    const taxonomyTerms = await apiFetch({ path: `/wp/v2/${taxonomy.slug}` });
                    terms[taxonomy.slug] = taxonomyTerms.map((term) => ({ label: term.name, value: term.slug }));
                }
                setTaxonomyTerms(terms);
            };

            if (taxonomies.length) {
                fetchTerms();
            }
        }, [taxonomies]);

        const updateTaxonomy = (taxonomy, term) => {
            setAttributes({
                selectedTaxonomy: {
                    ...selectedTaxonomy,
                    [taxonomy]: term,
                },
            });
        };

        return (
            <>
                <InspectorControls>
                    <PanelBody title="Filter Products">
                        {taxonomies &&
                            taxonomies.map((taxonomy) => (
                                <SelectControl
                                    key={taxonomy.slug}
                                    label={`Filter by ${taxonomy.name}`}
                                    value={selectedTaxonomy[taxonomy.slug]}
                                    options={[
                                        { label: 'All', value: '' },
                                        ...(taxonomyTerms[taxonomy.slug] || []),
                                    ]}
                                    onChange={(term) => updateTaxonomy(taxonomy.slug, term)}
                                />
                            ))}
                    </PanelBody>
                    <PanelBody title="Grid Settings">
                        <SelectControl
                            label="Columns"
                            value={columns}
                            options={[
                                { label: '1 Column', value: 1 },
                                { label: '2 Columns', value: 2 },
                                { label: '3 Columns', value: 3 },
                                { label: '4 Columns', value: 4 },
                                { label: '5 Columns', value: 5 },
                                { label: '6 Columns', value: 6 },
                            ]}
                            onChange={(newColumnCount) => setAttributes({ columns: parseInt(newColumnCount, 10) })}
                        />
                    </PanelBody>
                </InspectorControls>
                <div className={`wpd-product-display wpd-columns-${columns}`}>
                    {/* Placeholder for displaying the products */}
                    <p>Select taxonomy filters from the sidebar.</p>
                </div>
            </>
        );
    },
    save: () => {
        return null; // Rendered in PHP.
    },
});
