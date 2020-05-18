<template>
    <input
        class="flex-1 px-3 py-2 border border-orange-800 bg-orange-600 focus:bg-orange-300 focus:text-gray-800 outline-none placeholder-white"
        placeholder="Enter commands here"
        v-model="command"
        @keypress.enter="doCommand()"
    />
</template>

<script>
    import * as matter from "gray-matter";

    export default {
        name: 'tag-command-line',
        data() {
            return {
                command: null,
                commands: {},
                aliases: {},
                ignore: [
                    'a','an','the',
                    'in','on','at','of','for', 'under','over','with','after','before', 'as','below','by', 'from','to','near','into',
                    'inside','outside','within','without','toward','towards','across','against','along','around','beneath','beside',
                    'besides','between','off','past','underneath','upon','via',
                    'up','down',
                ],
            }
        },
        methods: {
            doCommand() {
                // Parse Command
                let command = this.parse()

                // Display Command
                EventBus.fire('command-sent',{
                    command: Object.values(command).join(' '),
                    string: this.command,
                    error: false,
                });
                // Display Command Results

                // Reset Command Prompt
                this.command = null;
            },

            parse() {
                let command_object = [];
                let parsed_string = this.command.split(' ');
                let command = this.isValidCommand(parsed_string[0]);
                parsed_string = this.stripIgnoredWords(parsed_string);
                let format = this.getFormat(command);

                this.hasParameters(parsed_string, format); // throws an error if not right

                command_object = this.createObject(parsed_string, format);

                return command_object;
            },
            isValidCommand(command) {
                if(this.aliases[command] === undefined) {
                    EventBus.fire('command-sent',{
                        command: `Unknown command - ${command}`,
                        string: this.command,
                        error: true,
                    });
                    throw 'Invalid Command';
                }
                return this.aliases[command];
            },
            stripIgnoredWords(string) {
                let output = [];
                let special_cases = (string[0] === 'move' && (string[1] === 'up' || string[1] === 'down'));
                if(! special_cases) {
                    for(let i in string) {
                        let part = string[i];
                        if(! this.ignore.includes(part)) {
                        output.push(part);
                        }
                    }
                }
                else {
                    output = string;
                }
                return output;
            },
            getFormat(command) {
                let format_syntax = this.commands[command].format;
                let obj = [];
                let re = /<([\w \|\?]+)>/g;
                let match = format_syntax.match(re);
                for(let i in match) {
                    let part = match[i].replace('<','').replace('>','');
                    obj.push(part);
                }
                return obj;
            },
            hasParameters(string, format) {
                let count = 0;
                for(let i in format) {
                    let f = format[i];
                    if(! f.includes('?')){
                        count++;
                    }
                }
                if(string.length < count) {
                    EventBus.fire('command-sent',{
                        command: 'Can\'t find enough objects',
                        string: this.command,
                        error: true,
                    });
                    throw 'Invalid Command';
                }
                return true;
            },
            createObject(string, format) {
                let obj = {};

                for(let i in format) {
                    let f = format[i];
                    let s = string[i];
                    obj[f] = s;
                }

                return obj;
            }
        },
        mounted() {
            axios.get('./game/commands.md')
                .then((response) => {
                    let file = response.data;
                    let data = matter(file);
                    let commands = data.data;
                    this.commands = commands;

                    for(let command in commands) {
                        let info = commands[command];
                        this.aliases[command] = command;
                        for(let key in info.aliases){
                            let alias = info.aliases[key];
                            this.aliases[alias] = command;
                        }
                    }
                })
                .catch((error) => {
                    console.log(error);
                })
        }
    }
</script>
