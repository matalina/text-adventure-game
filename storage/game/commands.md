---
move:
    description: Move in a given direction, or to a specific room.
    format: <command> <object>
    aliases: [go, walk, run]
get:
    description: Pick up an object
    format: <command> <object>
    aliases: [grab,take,pick,hold]
put:
    description: Put an object on or in another object. If a second object is not specified it will be put into your backpack if it fits.
    format: <command> <object> <xn_object?>
    aliases: [place,set]
drop:
    description: Drop an object on the floor.
    format: <command> <object>
    aliases: []
open:
    description: Open an object
    format: <command> <object>
    aliases: []
close:
    description: Close an object
    format: <command> <object>
    aliases: []
look:
    description: Look at an object, room or another person
    format: <command> <object?>
    aliases: [see,view]
search:
    description: Search an open object, or a room you are in to find hidden objects
    format: <command> <object?>
    aliases: [study]
lock:
    description: Lock an object with a key. Some objects can be locked without a key.
    format: <command> <object> <key?>
    aliases: []
unlock:
    description: Unlock an object with a key. Some objects can be unlocked with out a specific key.
    format: <command> <object> <key?>
    aliases: []
use:
    description: Use an object
    format: <command> <object>
    aliases: []
eat:
    description: Eat an object if edible
    format: <command> <object>
    aliases: []
drink:
    description: Drink an object if drinkable
    format: <command> <object>
    aliases: []
wear:
    description: Wear an object if wearable. If another like object is worn the old item will be removed first and placed in your backpack
    format: <command> <object>
    aliases: [equip]
remove:
    description: Remove a wearable object and place in your backpack.
    format: <command> <object>
    aliases: [unequip]
say:
    description: Say an option on the screen during a conversation
    format: <command> <number>
    aliases: [answer, talk, speak, choose]
reset:
    description: Restart the game
    format: <command>
    aliases: [restart,clear]
character:
    description: View your character
    format: <command>
    aliases: [stats,skills]
inventory:
    description: View your inventory
    format: <command>
    aliases: [bags,gear]
map:
    description: View the current map
    format: <command>
    aliases: [world,path]
---
