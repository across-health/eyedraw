/**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2013
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2013, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */

/**
 * Round hole
 *
 * @class FieldCircle
 * @property {String} className Name of doodle subclass
 * @param {Drawing} _drawing
 * @param {Object} _parameterJSON
 */
ED.FieldCircle = function(_drawing, _parameterJSON) {
	// Set classname
	this.className = "FieldCircle";

	// Derived parameters
	this.colour = new ED.Colour(255,0,0,1);

	// Saved parameters
	this.savedParameterArray = ['originX', 'originY', 'colour'];

	// Call superclass constructor
	ED.Doodle.call(this, _drawing, _parameterJSON);
}

/**
 * Sets superclass and constructor
 */
ED.FieldCircle.prototype = new ED.Doodle;
ED.FieldCircle.prototype.constructor = ED.FieldCircle;
ED.FieldCircle.superclass = ED.Doodle.prototype;

/**
 * Sets default properties
 */
ED.FieldCircle.prototype.setPropertyDefaults = function() {
	this.isMoveable = false;
	this.isRotatable = false;

	// Add complete validation arrays for derived parameters
	this.parameterValidationArray['colour'] = {
		kind: 'derived',
		type: 'colour',
	};
}

/**
 * Sets default parameters (Only called for new doodles)
 * Use the setParameter function for derived parameters, as this will also update dependent variables
 */
ED.FieldCircle.prototype.setParameterDefaults = function() {

}

/**
 * Draws doodle or performs a hit test if a Point parameter is passed
 *
 * @param {Point} _point Optional point in canvas plane, passed if performing hit test
 */
ED.FieldCircle.prototype.draw = function(_point) {
	// Get context
	var ctx = this.drawing.context;

	// Call draw method in superclass
	ED.FieldCircle.superclass.draw.call(this, _point);

	// Boundary path
	ctx.beginPath();

	// Round hole
	ctx.arc(0, 0, 50, 0, Math.PI * 2, true);

	// Close path
	ctx.closePath();

	// Set line attributes
	ctx.lineWidth = 1;
	ctx.fillStyle = this.colour.rgba();
	ctx.strokeStyle = ctx.fillStyle;

	// Draw boundary path (also hit testing)
	this.drawBoundary(_point);

	// Return value indicating successful hittest
	return this.isClicked;
}
