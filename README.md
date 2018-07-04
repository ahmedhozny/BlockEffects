# BlockEffects

## Description
A PMMP plugin that gives players effects as they walk on blocks specified in config.yml .

## Features
- You can give more than an effect when players walk on single block.

- For each effect, you can set duration, amplifier, either bubbles and particles are visible or not.

- Give players effect only if the block beneath the block they are walking on exists.

## Configuration

Here's a sample of how config.yml should look like:

    enabled: true  _setting this to false will disable the plugin and no effects will be given_
    blocks:
      "5:0":       _Block ID and Damage ID . All IDs MUST be like that, between "" and Meta included_
        - effect: 1
          duration: 3
          amplifier: 2
          visible: true
          beneath: "49:0" _Checks the block beneath the block that the player is walking on_
        - effect: 8
          duration: 8
          amplifier: 1
          visible: false

## Contribution

Feel free to contribute if you have ideas or found an issue. Links:

- [Open an issue or request](https://github.com/killer549/BlockEffects/issues)
- [Add something new or fix a bug](https://github.com/killer549/BlockEffects/pulls)

## Licensing information
	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU Lesser General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU Lesser General Public License for more details.

	You should have received a copy of the GNU Lesser General Public License
	along with this program.  If not, see <http://www.gnu.org/licenses/>.
	
