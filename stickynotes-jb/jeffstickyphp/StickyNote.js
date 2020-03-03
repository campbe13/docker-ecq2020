/**
 * Used to store useful methods and charateristics of a sticky note. 
 */
class StickyNote {

    /**
     * Used to construct a Sticky Note object. Either provide just the id and text or provide all parameters
     * in order to simplify logic. 
     * 
     * @param {*} id of the sticky note (store in database) 
     * @param {*} text of the sticky note (default 0)
     * @param {*} top position of sticky note (default 0)
     * @param {*} left position of sticky note (default 0)
     * @param {*} right position of sticky note (default 0)
     * @param {*} bottom position of sticky note (default 0)
     * @param {*} zIndex of the sticky note (default 2)
     */
    constructor(id, text, top = 0, left = 0, zIndex = 2) {

        this.id = id;
        this.text = text;
        this.top = top; 
        this.left = left; 
        this.zIndex = zIndex; 

    }

}