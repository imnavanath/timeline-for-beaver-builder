<?php
/**
 * @class BSFBBTimelines
 */
class BSFBBTimelines extends FLBuilderModule {
    /** 
     * Constructor function for the module. You must pass the
     * name, description, dir and url in an array to the parent class.
     *
     * @method __construct
     */  
    public function __construct()
    {
        parent::__construct(array(
            'name'          => __('Timeline', 'bb-timeline'),
            'description'   => __('To create Bootstrap Card builder modules.', 'bb-timeline'),
            'category'		=> __('Advanced Modules', 'bb-timeline'),
            'dir'           => BB_TIMELINE_DIR . 'bb-timeline-module/',
            'url'           => BB_TIMELINE_URL . 'bb-timeline-module/',
            'partial_refresh' => false // Defaults to false and can be omitted.
        )); 

        $this->add_js('jquery-waypoints');

        // Register and enqueue your own.
        $this->add_css( 'animate', BB_TIMELINE_URL . 'assets/css/animate.css' );
    }

    /**
     * @method update
     * @param $settings {object}
     */
    public function update($settings)
    {
        // Make sure we have a photo_src property.
        if(!isset($settings->photo_src)) {
            $settings->photo_src = '';
        }
        // Cache the attachment data.
        $data = FLBuilderPhoto::get_attachment_data($settings->photo);

        if($data) {
            $settings->data = $data;
        }
        return $settings;
    }
}



/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('BSFBBTimelines', 
    array(

        //General
        'general'       => array( // Tab
            'title'         => __('General', 'bb-timeline'), // Tab title
            'sections'      => array( // Tab Sections
                //Timeline layout Option
                'layout'       => array( // Section
                    'title'         => 'Select Layout', // Section Title
                    'fields'        => array( // Section Fields
                        'timeline_layout'       => array(
                            'type'          => 'select',
                            'label'         => __('Timeline Layouts', 'bb-timeline'),
                            'default'       => 'left',
                            'options'       => array(
                                'left'             => __('Left', 'bb-timeline'),
                                'right'             => __('Right', 'bb-timeline'),
                                'both'             => __('Both', 'bb-timeline')
                            ),
                            'help'         => __('This is to set timeline layout.', 'bb-timeline'),
                            'toggle'        => array(
                                'left'      => array(
                                    'sections'      => array( 'left' ),
                                    'tabs'      => array( 'timeline1' )
                                ),
                                'right'      => array(
                                    'sections'      => array( 'right' ),
                                    'tabs'      => array( 'timeline1' )
                                ),
                                'both'      => array(
                                    'sections'      => array( 'both' ),
                                    'tabs'      => array( 'timeline1' )
                                )
                            ),
                        ),
                    )
                ),

                //Date Format
                'date_format_section'       => array( // Section
                    'title'         => __('Select Date Format', 'bb-timeline'), // Section Title
                    'fields'        => array( // Section Fields
                        'date_format'   => array(
                            'type'          => 'select',
                            'label'         => __('Date Format', 'bb-timeline'),
                            'default'       => 'M j, Y',
                            'options'       => array(
                                'M j, Y'        => date('M j, Y'),
                                'F j, Y'        => date('F j, Y'),
                                'm/d/Y'         => date('m/d/Y'),
                                'm-d-Y'         => date('m-d-Y'),
                                'd M Y'         => date('d M Y'),
                                'd F Y'         => date('d F Y'),
                                'Y-m-d'         => date('Y-m-d'),
                                'Y/m/d'         => date('Y/m/d'),
                            )
                        ),
                    ),
                ),
            )
        ),

        //Add Timeline
        'timeline'      => array( // Tab
            'title'         => __('Timeline', 'bb-timeline'), // Tab title
            'sections'      => array( // Tab Sections
                'general'       => array( // Section
                    'title'         => '', // Section Title
                    'fields'        => array( // Section Fields
                        'timeline1'     => array(
                            'type'          => 'form',
                            'label'         => __('Timeline', 'bb-timeline'),
                            'form'          => 'bb_timeline_form', // ID from registered form below
                            'preview_text'  => 'timeline_title', // Name of a field to use for the preview text
                            'multiple'      => true
                        ),
                    )
                )
            )
        ),

        //Timeline Style
        'timeline_style'     => array(
            'title'         => __('Style', 'bb-timeline'),
            'sections'      => array(
                //Timeline Animation
                'anim_general'          => array(
                    'title'         => 'Timeline Animation',
                    'fields'        => array(
                        'tm_animation'         => array(
                            'type'          => 'select',
                            'label'         => __('Animation', 'bb-timeline'),
                            'default'       => 'no',
                            'help'          => __('Choose one of the animation types for timeline.','bb-timeline'),
                            'options'       => array(
                                'no'                => __('No', 'bb-timeline'),
                                'bounce'            => __( 'bounce' , 'bb-timeline' ),
                                'flash'             => __( 'flash' , 'bb-timeline' ),
                                'pulse'             => __( 'pulse' , 'bb-timeline' ),
                                'rubberBand'        => __( 'rubberBand' , 'bb-timeline' ),
                                'shake'             => __( 'shake' , 'bb-timeline' ),
                                'headShake'         => __( 'headShake' , 'bb-timeline' ),
                                'swing'             => __( 'swing' , 'bb-timeline' ),
                                'tada'              => __( 'tada' , 'bb-timeline' ),
                                'wobble'            => __( 'wobble' , 'bb-timeline' ),
                                'jello'             => __( 'jello' , 'bb-timeline' ),
                                'bounceIn'          => __( 'bounceIn' , 'bb-timeline' ),
                                'bounceInDown'      => __( 'bounceInDown' , 'bb-timeline' ),
                                'bounceInLeft'      => __( 'bounceInLeft' , 'bb-timeline' ),
                                'bounceInRight'     => __( 'bounceInRight' , 'bb-timeline' ),
                                'bounceInUp'        => __( 'bounceInUp' , 'bb-timeline' ),
                                'fadeIn'            => __( 'fadeIn' , 'bb-timeline' ),
                                'fadeInDown'        => __( 'fadeInDown' , 'bb-timeline' ),
                                'fadeInDownBig'     => __( 'fadeInDownBig' , 'bb-timeline' ),
                                'fadeInLeft'        => __( 'fadeInLeft' , 'bb-timeline' ),
                                'fadeInLeftBig'     => __( 'fadeInLeftBig' , 'bb-timeline' ),
                                'fadeInRight'       => __( 'fadeInRight' , 'bb-timeline' ),
                                'fadeInRightBig'    => __( 'fadeInRightBig' , 'bb-timeline' ),
                                'fadeInUp'          => __( 'fadeInUp' , 'bb-timeline' ),
                                'fadeInUpBig'       => __( 'fadeInUpBig' , 'bb-timeline' ),
                                'flipInX'           => __( 'flipInX' , 'bb-timeline' ),
                                'flipInY'           => __( 'flipInY' , 'bb-timeline' ),
                                'flipOutX'          => __( 'flipOutX' , 'bb-timeline' ),
                                'flipOutY'          => __( 'flipOutY' , 'bb-timeline' ),
                                'lightSpeedIn'      => __( 'lightSpeedIn' , 'bb-timeline' ),
                                'rotateIn'          => __( 'rotateIn' , 'bb-timeline' ),
                                'rotateInDownLeft'  => __( 'rotateInDownLeft' , 'bb-timeline' ),
                                'rotateInDownRight' => __( 'rotateInDownRight' , 'bb-timeline' ),
                                'rotateInUpLeft'    => __( 'rotateInUpLeft' , 'bb-timeline' ),
                                'rotateInUpRight'   => __( 'rotateInUpRight' , 'bb-timeline' ),
                                'rollIn'            => __( 'rollIn' , 'bb-timeline' ),
                                'zoomIn'            => __( 'zoomIn' , 'bb-timeline' ),
                                'zoomInDown'        => __( 'zoomInDown' , 'bb-timeline' ),
                                'zoomInLeft'        => __( 'zoomInLeft' , 'bb-timeline' ),
                                'zoomInRight'       => __( 'zoomInRight' , 'bb-timeline' ),
                                'zoomInUp'          => __( 'zoomInUp' , 'bb-timeline' ),
                                'slideInDown'       => __( 'slideInDown' , 'bb-timeline' ),
                                'slideInLeft'       => __( 'slideInLeft' , 'bb-timeline' ),
                                'slideInRight'      => __( 'slideInRight' , 'bb-timeline' ),
                                'slideInUp'         => __( 'slideInUp' , 'bb-timeline' ),
                            ),                      
                        ),

                        'tm_animation_delay'          => array(
                            'type'          => 'text',
                            'label'         => __('Animation Delay', 'bb-timeline'),
                            'placeholder'   => '0',
                            'help'          => 'Delay the animation effect for milliseconds you entered.',
                            'maxlength'     => '3',
                            'size'          => '6',
                            'description'   => 'ms',
                        ),

                        'tm_animation_duration'          => array(
                            'type'          => 'text',
                            'label'         => __('Animation Duration', 'bb-timeline'),
                            'default'       => '1',
                            'placeholder'   => '1',
                            'help'          => 'How long the animation effect should last. Decides the speed of effect.',
                            'maxlength'     => '3',
                            'size'          => '6',
                            'description'   => 's',
                        ),

                        'tm_viewport_position'          => array(
                            'type'          => 'text',
                            'label'         => __('Viewport Position', 'bb-timeline'),
                            'placeholder'   => '90',
                            'help'          => 'The area of screen from top where animation effect will start working.',
                            'maxlength'     => '3',
                            'size'          => '6',
                            'description'   => '%',
                        ),
                    )
                ),

                //Timeline Connector Styling
                'timeline_connector'     => array(
                    'title'         => __('Timeline Connector', 'bb-timeline'),
                    'fields'        => array(

                        'connector_border_style'         => array(
                            'type'          => 'select',
                            'label'         => __('Connector line Style', 'bb-timeline'),
                            'default'       => 'solid',
                            'options'       => array(
                                'none'       =>  __('None', 'bb-timeline'),
                                'solid'         => _x( 'Solid', 'Border type.', 'bb-timeline' ),
                                'dashed'        => _x( 'Dashed', 'Border type.', 'bb-timeline' ),
                                'dotted'        => _x( 'Dotted', 'Border type.', 'bb-timeline' ),
                                'double'        => _x( 'Double', 'Border type.', 'bb-timeline' )
                            ),
                            'help'         => __('For Double style effect, Connector line Width must be above 4px.', 'bb-timeline'),

                            'toggle'        => array(
                                'solid'        => array(
                                    'fields'        => array( 'connector_border_width', 'connector_border_color', 'connector_bg_color', 'connector_bg_color_opc', 'timeline_icon_border_bg_color' )
                                ),
                                'dashed'        => array(
                                    'fields'        => array( 'connector_border_width', 'connector_border_color', 'connector_bg_color', 'connector_bg_color_opc', 'timeline_icon_border_bg_color' )
                                ),
                                'dotted'        => array(
                                    'fields'        => array( 'connector_border_width', 'connector_border_color', 'connector_bg_color', 'connector_bg_color_opc', 'timeline_icon_border_bg_color' )
                                ),
                                'double'        => array(
                                    'fields'        => array( 'connector_border_width', 'connector_border_color', 'connector_bg_color', 'connector_bg_color_opc', 'timeline_icon_border_bg_color' )
                                )
                            )
                        ),

                        'connector_border_width'        => array(
                            'type'          => 'text',
                            'label'         => __('Connector line Width', 'bb-timeline'),
                            'default'       => '5',
                            'maxlength'     => '2',
                            'size'          => '4',
                            'description'   => 'px',
                            'help'         => __('To manage connector line width this width will also applied to icon border.', 'bb-timeline')
                        ),


                        'connector_bg_color' => array( 
                            'type'       => 'color',
                            'label'         => __('Connector line Color', 'bb-timeline'),
                            'default'    => '',
                            'show_reset' => true
                        ),

                        'connector_bg_color_opc' => array( 
                            'type'        => 'text',
                            'label'       => __('Connector line Opacity', 'bb-timeline'),
                            'default'     => '50',
                            'description' => '%',
                            'maxlength'   => '3',
                            'size'        => '4',
                            'help'         => __('To manage connector line opacity.', 'bb-timeline')
                        ),

                        'timeline_icon_border_bg_color' => array( 
                            'type'       => 'color',
                            'label'         => __('Icon Background Color', 'bb-timeline'),
                            'default'    => '',
                            'show_reset' => true
                        ),

                        'connector_border_radius' => array(
                            'type'          => 'text',
                            'label'         => __('Icon Border Corners', 'bb-timeline'),
                            'default'     => '50',
                            'maxlength'     => '3',
                            'size'          => '4',
                            'description'   => '%',
                            'help'         => __('To manage icon border corners.', 'bb-timeline')
                        ),

                    )
                ),
            )
        ),   

        //Timeline Typography
        'timeline_typography'         => array(
            'title'         => __('Typography', 'bb-timeline'),
            'sections'      => array(

                //Timeline Title
                'timeline_title_typography'     => array(
                    'title'         => __('Title', 'bb-timeline'),
                    'fields'        => array(
                        'tmtitle_tag'           => array(
                            'type'          => 'select',
                            'label'         => __( 'HTML Tag', 'bb-timeline' ),
                            'default'       => 'h2',
                            'options'       => array(
                                'h1'            =>  'h1',
                                'h2'            =>  'h2',
                                'h3'            =>  'h3',
                                'h4'            =>  'h4',
                                'h5'            =>  'h5',
                                'h6'            =>  'h6'
                            )
                        ),

                        'timeline_title_font'          => array(
                            'type'          => 'font',
                            'default'       => array(
                                'family'        => 'Default',
                                'weight'        => 300
                            ),
                            'label'         => __('Font Family', 'bb-timeline'),
                            'preview'         => array(
                                'type'            => 'font',
                                'selector'        => '.bb-timline-title'
                            )
                        ),

                        'timeline_title_custom_size' => array(
                            'type'              => 'text',
                            'label'             => __('Font Size', 'bb-timeline'),
                            'default'           => '20',
                            'maxlength'         => '3',
                            'size'              => '4',
                            'description'       => 'px'
                        ),

                        'timeline_title_custom_line_height' => array(
                            'type'          => 'text',
                            'label'         => __('Line Height', 'bb-timeline'),
                            'default'       => '30',
                            'maxlength'     => '4',
                            'size'          => '4',
                            'description'   => 'px'
                        ),

                        'timeline_title_custom_letter_spacing' => array(
                            'type'          => 'text',
                            'label'         => __('Letter Spacing', 'bb-timeline'),
                            'default'       => '0',
                            'maxlength'     => '3',
                            'size'          => '4',
                            'description'   => 'px'
                        ),

                        'timeline_title_color'    => array( 
                            'type'       => 'color',
                            'label'         => __('Text Color', 'bb-timeline'),
                            'default'    => '',
                            'show_reset' => true,
                            'preview'       => array(
                                'type' => 'css',
                                'property' => 'color',
                                'selector' => '.bb-timline-title'
                            )
                        ),

                        'timeline_title_align'     => array(
                            'type'          => 'select',
                            'label'         => __('Title Alignment', 'bb-timeline'),
                            'default'       => 'Left',
                            'options'       => array(
                                'left'      =>  __('Left', 'bb-timeline'),
                                'center'    =>  __('Center', 'bb-timeline'),
                                'right'     =>  __('Right', 'bb-timeline')
                            ),
                        ),

                        'timeline_title_margin_top' => array(
                            'type'              => 'text',
                            'label'             => __('Margin Top', 'bb-timeline'),
                            'placeholder'       => '0',
                            'maxlength'         => '3',
                            'size'              => '4',
                            'description'       => 'px',
                            'default'    => '',
                            'preview'       => array(
                                'type' => 'css',
                                'property' => 'margin-top',
                                'selector' => '.bb-timline-title',
                                'unit'       => 'px'
                            )
                        ),

                        'timeline_title_margin_bottom' => array(
                            'type'              => 'text',
                            'label'             => __('Margin Bottom', 'bb-timeline'),
                            'placeholder'       => '0',
                            'maxlength'         => '3',
                            'size'              => '4',
                            'description'       => 'px',
                            'default'    => '10',
                            'preview'       => array(
                                'type' => 'css',
                                'property' => 'margin-bottom',
                                'selector' => '.bb-timline-title',
                                'unit'       => 'px'
                            )
                        )
                    )
                ),
                               
                //Timeline Description
                'timeline_description_typography'     => array(
                    'title'         => __('Description', 'bb-timeline'),
                    'fields'        => array(

                        'timeline_dec_font'          => array(
                            'type'          => 'font',
                            'default'       => array(
                                'family'        => 'Default',
                                'weight'        => 300
                            ),
                            'label'         => __('Font Family', 'bb-timeline'),
                            'preview'         => array(
                                'type'            => 'font',
                                'selector'        => '.bb-timline-dec'
                            )
                        ),

                        'timeline_dec_custom_size' => array(
                            'type'              => 'text',
                            'label'             => __('Font Size', 'bb-timeline'),
                            'default'           => '18',
                            'maxlength'         => '3',
                            'size'              => '4',
                            'description'       => 'px'
                        ),

                        'timeline_dec_custom_line_height' => array(
                            'type'          => 'text',
                            'label'         => __('Line Height', 'bb-timeline'),
                            'default'       => '30',
                            'maxlength'     => '4',
                            'size'          => '4',
                            'description'   => 'px'
                        ),

                        'timeline_dec_custom_letter_spacing' => array(
                            'type'          => 'text',
                            'label'         => __('Letter Spacing', 'bb-timeline'),
                            'default'       => '0',
                            'maxlength'     => '3',
                            'size'          => '4',
                            'description'   => 'px'
                        ),

                        'timeline_dec_color'    => array( 
                            'type'       => 'color',
                            'label'         => __('Text Color', 'bb-timeline'),
                            'default'    => 'ffffff',
                            'show_reset' => true,
                            'preview'       => array(
                                'type' => 'css',
                                'property' => 'color',
                                'selector' => '.bb-timline-dec'
                            )
                        ),

                        'timeline_dec_margin_top' => array(
                            'type'              => 'text',
                            'label'             => __('Margin Top', 'bb-timeline'),
                            'placeholder'       => '0',
                            'maxlength'         => '3',
                            'size'              => '4',
                            'description'       => 'px',
                            'default'    => '15',
                            'preview'       => array(
                                'type' => 'css',
                                'property' => 'margin-top',
                                'selector' => '.bb-timline-dec',
                                'unit'       => 'px'
                            )
                        ),

                        'timeline_dec_margin_bottom' => array(
                            'type'              => 'text',
                            'label'             => __('Margin Bottom', 'bb-timeline'),
                            'placeholder'       => '0',
                            'maxlength'         => '3',
                            'size'              => '4',
                            'description'       => 'px',
                            'default'    => '0',
                            'preview'       => array(
                                'type' => 'css',
                                'property' => 'margin-bottom',
                                'selector' => '.bb-timline-dec',
                                'unit'       => 'px'
                            )
                        )
                    )
                ),
                
                //Timeline Date
                'timeline_date_typography'     => array(
                    'title'         => __('Date', 'bb-timeline'),
                    'fields'        => array(

                        'timeline_date_font'          => array(
                            'type'          => 'font',
                            'default'       => array(
                                'family'        => 'Default',
                                'weight'        => 300
                            ),
                            'label'         => __('Font Family', 'bb-timeline'),
                            'preview'         => array(
                                'type'            => 'font',
                                'selector'        => '.bb-tmtime'
                            )
                        ),

                        'timeline_date_custom_size' => array(
                            'type'              => 'text',
                            'label'             => __('Font Size', 'bb-timeline'),
                            'default'           => '18',
                            'maxlength'         => '3',
                            'size'              => '4',
                            'description'       => 'px'
                        ),

                        'timeline_date_custom_line_height' => array(
                            'type'          => 'text',
                            'label'         => __('Line Height', 'bb-timeline'),
                            'default'       => '30',
                            'maxlength'     => '4',
                            'size'          => '4',
                            'description'   => 'px'
                        ),

                        'timeline_date_custom_letter_spacing' => array(
                            'type'          => 'text',
                            'label'         => __('Letter Spacing', 'bb-timeline'),
                            'default'       => '0',
                            'maxlength'     => '3',
                            'size'          => '4',
                            'description'   => 'px'
                        ),

                        'timeline_date_color'    => array( 
                            'type'       => 'color',
                            'label'         => __('Text Color', 'bb-timeline'),
                            'default'    => 'bdd0db',
                            'show_reset' => true,
                            'preview'       => array(
                                'type' => 'css',
                                'property' => 'color',
                                'selector' => '.bb-tmtime'
                            )
                        ),
                    )
                ),
            )
        ),      
    )
);

/**
 * Register a settings form to use in the "form" field type above.
 */
FLBuilder::register_settings_form('bb_timeline_form', array(
    'title' => __('Add Timeline', 'bb-timeline'),
    'tabs'  => array(
        'general'      => array( // Tab
            'title'         => __('General', 'bb-timeline'), // Tab title
            'sections'      => array( // Tab Sections
                
                //Title
                'timeline_title_section'       => array( // Section
                    'title'         => __('', 'bb-timeline'), // Section Title
                    'fields'        => array( // Section Fields
                        'timeline_title' => array(
                            'type'          => 'text',
                            'label'         => __('Timeline Title', 'bb-timeline'),
                            'default'       => 'Title of section',
                        )

                    ),
                ),

                //Description
                'timeline_editor_section'       => array( // Section
                    'title'         => __('', 'bb-timeline'), // Section Title
                    'fields'        => array( // Section Fields
                        'timeline_editor'          => array(
                            'type'          => 'editor',
                            'rows'          => 5,
                            'default'       => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde? Iste voluptatibus minus veritatis qui ut.'
                        ),
                    ),
                ),

                // Timeline Icon / Image 
                'timeline_img_icon'       => array(
                    'title'         => __( 'Timeline Icon / Image', 'bb-timeline' ),
                    'fields'        => array(
                        'timeline_img_icon_type'    => array(
                            'type'          => 'select',
                            'label'         => __('Select Type', 'bb-timeline'),
                            'default'       => 'icon',
                            'options'       => array(
                                'none'          => __( 'None', 'Image type.', 'bb-timeline' ),
                                'icon'          => __('Icon', 'bb-timeline'),
                                'photo'         => __('Image', 'bb-timeline'),
                            ),
                            'toggle'        => array(
                                'icon'          => array(
                                    'sections'   => array( 'timeline_icon',  'timeline_icon_style', 'timeline_icon_colors' ),
                                ),
                                'photo'         => array(
                                    'sections'   => array( 'timeline_img' ),
                                )
                            ),
                        ),
                    ),
                ),

                // Icon Basic Setting 
                'timeline_icon'        => array( // Section
                    'title'         => 'Icon', // Section Title
                    'fields'        => array( // Section Fields
                        'timeline_icon_style'          => array(
                            'type'          => 'icon',
                            'label'         => __('Icon', 'bb-timeline'),
                            'default' => 'fa fa-circle-o',
                            'show_remove' => true,
                        ),

                        'timeline_icon_colors' => array( 
                            'type'       => 'color',
                            'label'      => __('Icon Color', 'bb-timeline'),
                            'default'    => '',
                            'show_reset' => true,
                        ),
                    )
                ),


                // Image Basic Setting
                'timeline_img'     => array( // Section
                    'title'         => 'Image', // Section Title
                    'fields'        => array( // Section Fields
                        'photo'         => array(
                            'type'          => 'photo',
                            'label'         => __('Image', 'bb-timeline'),
                            'show_remove'   => true,
                        ),
                    )
                ),
            )
        ),

        //Timeline Style
        'timeline_style'     => array(
            'title'         => __('Style', 'bb-timeline'),
            'sections'      => array(

                //Timeline Section Styling
                'timeline_bg_sections'     => array(
                    'title'         => __('Timeline Sections', 'bb-timeline'),
                    'fields'        => array(
                        'sections_bg_color' => array( 
                            'type'       => 'color',
                            'label'         => __('Background Color', 'bb-timeline'),
                            'default'    => '',
                            'show_reset' => true
                        ),

                        'sections_bg_color_opc' => array( 
                            'type'        => 'text',
                            'label'       => __('Opacity', 'bb-timeline'),
                            'default'     => '',
                            'description' => '%',
                            'maxlength'   => '3',
                            'size'        => '5'
                        ),
                    )
                ),

                //Separator
                'timeline_title_border'     => array(
                    'title'         => __('Separator', 'bb-timeline'),
                    'fields'        => array(

                        'timeline_title_border_style'         => array(
                            'type'          => 'select',
                            'label'         => __('Separator Style', 'bb-timeline'),
                            'default'       => 'solid',
                            'options'       => array(
                                'none'      =>  __('None', 'bb-timeline'),
                                'solid'     => _x( 'Solid', 'Border type.', 'bb-timeline' ),
                                'dashed'    => _x( 'Dashed', 'Border type.', 'bb-timeline' ),
                                'dotted'    => _x( 'Dotted', 'Border type.', 'bb-timeline' ),
                                'double'    => _x( 'Double', 'Border type.', 'bb-timeline' )
                            ),
                            'help'         => __('For Double style effect Separator Height must be above 3px', 'bb-timeline'),
                            'toggle'        => array(
                                'solid'        => array(
                                    'fields'        => array( 'timeline_title_border_width', 'timeline_title_border_color', 'timeline_title_seperator_width', 'timeline_title_border_align' )
                                ),
                                'dashed'        => array(
                                    'fields'        => array( 'timeline_title_border_width', 'timeline_title_border_color', 'timeline_title_seperator_width', 'timeline_title_border_align' )
                                ),
                                'dotted'        => array(
                                    'fields'        => array( 'timeline_title_border_width', 'timeline_title_border_color', 'timeline_title_seperator_width', 'timeline_title_border_align' )
                                ),
                                'double'        => array(
                                    'fields'        => array( 'timeline_title_border_width', 'timeline_title_border_color', 'timeline_title_seperator_width', 'timeline_title_border_align'  )
                                )
                            ),
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'      => '.bb-tmlabel-border-bottom',
                                'property'      => 'border-bottom-style'
                            ),
                        ),

                        'timeline_title_border_color'         => array(
                            'type'          => 'color',
                            'label'         => __('Separator Color', 'bb-timeline'),
                            'default'       => 'ffffff',
                            'show_reset' => true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'      => '.bb-tmlabel-border-bottom',
                                'property'      => 'border-bottom-color'
                            )
                        ),

                        'timeline_title_border_width'        => array(
                            'type'          => 'text',
                            'label'         => __('Separator Height', 'bb-timeline'),
                            'default'       => '1',
                            'maxlength'     => '2',
                            'size'          => '3',
                            'description'   => 'px',
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'      => '.bb-tmlabel-border-bottom',
                                'property'      => 'border-bottom-width',
                                'unit'          => 'px'
                            )
                        ),

                        'timeline_title_seperator_width'        => array(
                            'type'          => 'text',
                            'label'         => __('Seperator Width', 'bb-timeline'),
                            'default'       => '10',
                            'maxlength'     => '3',
                            'size'          => '3',
                            'description'   => '%',
                            
                        ),

                        'timeline_title_border_align'     => array(
                            'type'          => 'select',
                            'label'         => __('Separator Alignment', 'bb-timeline'),
                            'default'       => 'Left',
                            'options'       => array(
                                'left'      =>  __('Left', 'bb-timeline'),
                                'center'    =>  __('Center', 'bb-timeline'),
                                'right'     =>  __('Right', 'bb-timeline')
                            ),
                            'help'         => __('This is the alignment option for title border', 'bb-timeline'),
                        )
                    )
                ),
            )
        ),  

        //Add Date
        'timeline_date'       => array(
            'title'         => __('Timeline Date', 'bb-timeline'),
            'sections'      => array(
                //Title
                'date_show_hide_section'       => array( // Section
                    'title'         => __('Date Show / Hide', 'bb-timeline'), // Section Title
                    'fields'        => array( // Section Fields
                        'date_show_hide'         => array(
                            'type'          => 'select',
                            'label'         => __('Select Show / Hide', 'bb-timeline'),
                            'default'       => 'show',
                            'options'       => array(
                                'hide'      =>  __('Hide', 'bb-timeline'),
                                'show'      => __( 'Show', 'bb-timeline' )
                            ),
                            'toggle'        => array(
                                'show'        => array(
                                    'sections'            => array( 'date', 'date_format_section' ),
                                ),
                            )
                        )
                    ),
                ),

                //Set Date
                'date'       => array(
                    'title'         => __( 'Date', 'bb-timeline' ),
                    'fields'        => array(
                        'day'          => array(
                            'type'          => 'text',
                            'label'         => __('Day', 'bb-timeline'),
                            'default'       => date( 'd' ),
                            'maxlength'     => '2',
                            'size'          => '5',
                        ),
                        'month'         => array(
                            'type'          => 'text',
                            'label'         => __('Month', 'bb-timeline'),
                            'default'       => date( 'm' ),
                            'maxlength'     => '2',
                            'size'          => '5',
                        ),
                        'year'          => array(
                            'type'          => 'text',
                            'label'         => __('Year', 'bb-timeline'),
                            'default'       => date( 'Y' ),
                            'maxlength'     => '4',
                            'size'          => '5',
                            'description'   => __('<br/><br/>Please fill all three fields to display date.', 'bb-timeline'),
                        ),
                    )
                ),
            ),
        ),      
    )
));
